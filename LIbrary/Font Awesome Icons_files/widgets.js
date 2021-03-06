self._fontsize), fp_str(self._leading)))
        return ' '.join(R)

    def _textOut(self, text, TStar=0):
        "prints string at current point, ignores text cursor"
        self._code.append('%s%s' % (self._formatText(text), (TStar and ' T*' or '')))

    def textOut(self, text):
        """prints string at current point, text cursor moves across."""
        self._x = self._x + self._canvas.stringWidth(text, self._fontname, self._fontsize)
        self._code.append(self._formatText(text))

    def textLine(self, text=''):
        """prints string at current point, text cursor moves down.
        Can work with no argument to simply move the cursor down."""
        # Update the coordinates of the cursor
        self._x = self._x0
        if self._canvas.bottomup:
            self._y = self._y - self._leading
        else:
            self._y = self._y + self._leading

        # Update the location of the start of the line
        # self._x0 is unchanged
        self._y0 = self._y

        # Output the text followed by a PDF newline command
        self._code.append('%s T*' % self._formatText(text))

    def textLines(self, stuff, trim=1):
        """prints multi-line or newlined strings, moving down.  One
        comon use is to quote a multi-line block in your Python code;
        since this may be indented, by default it trims whitespace
        off each line and from the beginning; set trim=0 to preserve
        whitespace."""
        if isStr(stuff):
            lines = asUnicode(stuff).strip().split(u'\n')
            if trim==1:
                lines = [s.strip() for s in lines]
        elif isinstance(stuff,(tuple,list)):
            lines = stuff
        else:
            assert 1==0, "argument to textlines must be string,, list or tuple"

        # Output each line one at a time. This used to be a long-hand
        # copy of the textLine code, now called as a method.
        for line in lines:
            self.textLine(line)

    def __nonzero__(self):
        'PDFTextObject is true if it has something done after the init'
        return self._code != ['BT']

    def _setFillAlpha(self,v):
        self._canvas._doc.ensureMinPdfVersion('transparency')
        self._canvas._extgstate.set(self,'ca',v)

    def _setStrokeOverprint(self,v):
        self._canvas._extgstate.set(self,'OP',v)

    def _setFillOverprint(self,v):
        self._canvas._extgstate.set(self,'op',v)

    def _setOverprintMask(self,v):
        self._canvas._extgstate.set(self,'OPM',v and 1 or 0)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         #Copyright ReportLab Europe Ltd. 2000-2016
#see license.txt for license details
#history http://www.reportlab.co.uk/cgi-bin/viewcvs.cgi/public/reportlab/trunk/reportlab/platypus/__init__.py
__version__='3.3.0'
__doc__='''Page Layout and Typography Using Scripts" - higher-level framework for flowing documents'''

from reportlab.platypus.flowables import Flowable, Image, Macro, PageBreak, Preformatted, Spacer, XBox, \
                        CondPageBreak, KeepTogether, TraceInfo, FailOnWrap, FailOnDraw, PTOContainer, \
                        KeepInFrame, ParagraphAndImage, ImageAndFlowables, ListFlowable, ListItem, FrameBG, \
                        PageBreakIfNotEmpty
from reportlab.platypus.paragraph import Paragraph, cleanBlockQuotedText, ParaLines
from reportlab.platypus.paraparser import ParaFrag
from reportlab.platypus.tables import Table, TableStyle, CellStyle, LongTable
from reportlab.platypus.frames import Frame
from reportlab.platypus.doctemplate import BaseDocTemplate, NextPageTemplate, PageTemplate, ActionFlowable, \
                        SimpleDocTemplate, FrameBreak, PageBegin, Indenter, NotAtTopPageBreak
from reportlab.platypus.xpreformatted import XPreformatted
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  #Copyright ReportLab Europe Ltd. 2000-2016
#see license.txt for license details
#history http://www.reportlab.co.uk/cgi-bin/viewcvs.cgi/public/reportlab/trunk/reportlab/platypus/doctemplate.py

__version__='3.3.0'

__doc__="""
This module contains the core structure of platypus.

rlatypus constructs documents.  Document styles are determined by DocumentTemplates.

Each DocumentTemplate contains one or more PageTemplates which defines the look of the
pages of the document.

Each PageTemplate has a procedure for drawing the "non-flowing" part of the page
(for example the header, footer, page number, fixed logo graphic, watermark, etcetera) and
a set of Frames which enclose the flowing part of the page (for example the paragraphs,
tables, or non-fixed diagrams of the text).

A document is built when a DocumentTemplate is fed a sequence of Flowables.
The action of the build consumes the flowables in order and places them onto
frames on pages as space allows.  When a frame runs out of space the next frame
of the page is used.  If no frame remains a new page is created.  A new page
can also be created if a page break is forced.

The special invisible flowable NextPageTemplate can be used to specify
the page template for the next page (which by default is the one being used
for the current frame).
"""

from reportlab.platypus.flowables import *
from reportlab.lib.units import inch
from reportlab.platypus.paragraph import Paragraph
from reportlab.platypus.frames import Frame
from reportlab.rl_config import defaultPageSize, verbose
import reportlab.lib.sequencer
from reportlab.pdfgen import canvas
from reportlab.lib.utils import isSeq, encode_label, decode_label, annotateException, strTypes

try:
    set
except NameError:
    from sets import Set as set

import sys
import logging
logger = logging.getLogger("reportlab.platypus")

class LayoutError(Exception):
    pass

def _fSizeString(f):
    #used to get size during error messages
    w=getattr(f,'width',None)
    if w is None:
        w=getattr(f,'_width',None)

    h=getattr(f,'height',None)
    if h is None:
        h=getattr(f,'_height',None)
    #tables in particular may have some nasty large culprit
    if hasattr(f, '_culprit'):
        c = ', %s, ' % f._culprit()
    else:
        c = ''
    if w is not None or h is not None:
        if w is None: w='???'
        if h is None: h='???'
        return '(%s x %s)%s' % (w,h,c)
    return ''

def _doNothing(canvas, doc):
    "Dummy callback for onPage"
    pass

class PTCycle(list):
    def __new__(cls,*args,**kwds):
        self = list.__new__(cls,*args,**kwds)
        self._restart = 0
        self._idx = 0
        return self

    @property
    def next_value(self):
        v = self[self._idx]
        self._idx += 1
        if self._idx>=len(self):
            self._idx = self._restart
        return v

    @property
    def peek(self):
        return self[self._idx]

class IndexingFlowable(Flowable):
    """Abstract interface definition for flowables which might
    hold references to other pages or themselves be targets
    of cross-references.  XRefStart, XRefDest, Table of Contents,
    Indexes etc."""
    def isIndexing(self):
        return 1

    def isSatisfied(self):
        return 1

    def notify(self, kind, stuff):
        """This will be called by the framework wherever 'stuff' happens.
        'kind' will be a value that can be used to decide whether to
        pay attention or not."""
        pass

    def beforeBuild(self):
        """Called by multiBuild before it starts; use this to clear
        old contents"""
        pass

    def afterBuild(self):
        """Called after build ends but before isSatisfied"""
        pass

class ActionFlowable(Flowable):
    '''This Flowable is never drawn, it can be used for data driven controls
       For example to change a page template (from one column to two, for example)
       use NextPageTemplate which creates an ActionFlowable.
    '''
    def __init__(self,action=()):
        #must call super init to ensure it has a width and height (of zero),
        #as in some cases the packer might get called on it...
        Flowable.__init__(self)
        if not isSeq(action):
            action = (action,)
        self.action = tuple(action)

    def apply(self,doc):
        '''
        This is called by the doc.build processing to allow the instance to
        implement its behaviour
        '''
        action = self.action[0]
        args = tuple(self.action[1:])
        arn = 'handle_'+action
        if arn=="handle_nextPageTemplate" and args[0]=='main':
            pass
        try:
            getattr(doc,arn)(*args)
        except AttributeError as aerr:
            if aerr.args[0]==arn:
                raise NotImplementedError("Can't handle ActionFlowable(%s)" % action)
            else:
                raise
        except:
            annotateException("\nhandle_%s args=%s"%(action,ascii(args)))

    def __call__(self):
        return self

    def identity(self, maxLen=None):
        return "ActionFlowable: %s%s" % (str(self.action),self._frameName())

class LCActionFlowable(ActionFlowable):
    locChanger = 1                  #we cause a frame or page change

    def wrap(self, availWidth, availHeight):
        '''Should never be called.'''
        raise NotImplementedError

    def draw(self):
        '''Should never be called.'''
        raise NotImplementedError

class NextFrameFlowable(ActionFlowable):
    def __init__(self,ix,resume=0):
        ActionFlowable.__init__(self,('nextFrame',ix,resume))

class CurrentFrameFlowable(LCActionFlowable):
    def __init__(self,ix,resume=0):
        ActionFlowable.__init__(self,('currentFrame',ix,resume))

class NullActionFlowable(ActionFlowable):
    def apply(self,doc):
        pass

class _FrameBreak(LCActionFlowable):
    '''
    A special ActionFlowable that allows setting doc._nextFrameIndex

    eg story.append(FrameBreak('mySpecialFrame'))
    '''
    def __call__(self,ix=None,resume=0):
        r = self.__class__(self.action+(resume,))
        r._ix = ix
        return r

    def apply(self,doc):
        if getattr(self,'_ix',None):
            doc.handle_nextFrame(self._ix)
        ActionFlowable.apply(self,doc)

FrameBreak = _FrameBreak('frameEnd')
PageBegin = LCActionFlowable('pageBegin')

def _evalMeasurement(n):
    if isinstance(n,str):
        from reportlab.platypus.paraparser import _num
        n = _num(n)
        if isSeq(n): n = n[1]
    return n

class FrameActionFlowable(Flowable):
    _fixedWidth = _fixedHeight = 1
    def __init__(self,*arg,**kw):
        raise NotImplementedError('Abstract Class')

    def frameAction(self,frame):
        raise NotImplementedError('Abstract Class')

class Indenter(FrameActionFlowable):
    """Increases or decreases left and right margins of frame.

    This allows one to have a 'context-sensitive' indentation
    and makes nested lists way easier.
    """
    _ZEROSIZE=True
    width=0
    height=0
    def __init__(self, left=0, right=0):
        self.left = _evalMeasurement(left)
        self.right = _evalMeasurement(right)

    def frameAction(self, frame):
        frame._leftExtraIndent += self.left
        frame._rightExtraIndent += self.right

class NotAtTopPageBreak(FrameActionFlowable):
    def __init__(self,nextTemplate=None):
        self.nextTemplate = nextTemplate

    def frameAction(self,frame):
        if not frame._atTop:
            frame.add_generated_content(PageBreak(nextTemplate=self.nextTemplate))

class NextPageTemplate(ActionFlowable):
    """When you get to the next page, use the template specified (change to two column, for example)  """
    def __init__(self,pt):
        ActionFlowable.__init__(self,('nextPageTemplate',pt))

class PageTemplate:
    """
    essentially a list of Frames and an onPage routine to call at the start
    of a page when this is selected. onPageEnd gets called at the end.
    derived classes can also implement beforeDrawPage and afterDrawPage if they want
    """
    def __init__(self,id=None,frames=[],onPage=_doNothing, onPageEnd=_doNothing,
                 pagesize=None, autoNextPageTemplate=None,
                 cropBox=None,
                 artBox=None,
                 trimBox=None,
                 bleedBox=None,
                 ):
        frames = frames or []
        if not isSeq(frames): frames = [frames]
        assert [x for x in frames if not isinstance(x,Frame)]==[], "frames argument error"
        self.id = id
        self.frames = frames
        self.onPage = onPage
        self.onPageEnd = onPageEnd
        self.pagesize = pagesize
        self.autoNextPageTemplate = autoNextPageTemplate
        self.cropBox = cropBox
        self.artBox = artBox
        self.trimBox = trimBox
        self.bleedBox = bleedBox

    def beforeDrawPage(self,canv,doc):
        """Override this if you want additional functionality or prefer
        a class based page routine.  Called before any flowables for
        this page are processed."""
        pass

    def checkPageSize(self,canv,doc):
        """This gets called by the template framework
        If canv size != template size then the canv size is set to
        the template size or if that's not available to the
        doc size.
        """
        #### NEVER EVER EVER COMPARE FLOATS FOR EQUALITY
        #RGB converting pagesizes to ints means we are accurate to one point
        #RGB I suggest we should be aiming a little better
        cp = None
        dp = None
        sp = None
        if canv._pagesize: cp = list(map(int, canv._pagesize))
        if self.pagesize: sp = list(map(int, self.pagesize))
        if doc.pagesize: dp = list(map(int, doc.pagesize))
        if cp!=sp:
            if sp:
                canv.setPageSize(self.pagesize)
            elif cp!=dp:
                canv.setPageSize(doc.pagesize)
        for box in 'crop','art','trim','bleed':
            size = getattr(self,box+'Box',None)
            if size:
                canv.setCropBox(size,name=box)

    def afterDrawPage(self, canv, doc):
        """This is called after the last flowable for the page has
        been processed.  You might use this if the page header or
        footer needed knowledge of what flowables were drawn on
        this page."""
        pass

def _addGeneratedContent(flowables,frame):
    S = getattr(frame,'_generated_content',None)
    if S:
        flowables[0:0] = S
        del frame._generated_content

class onDrawStr(str):
    def __new__(cls,value,onDraw,label,kind=None):
        self = str.__new__(cls,value)
        self.onDraw = onDraw
        self.kind = kind
        self.label = label
        return self

class PageAccumulator:
    '''gadget to accumulate information in a page
    and then allow it to be interrogated at the end
    of the page'''
    _count = 0
    def __init__(self,name=None):
        if name is None:
            name = self.__class__.__name__+str(self.__class__._count)
            self.__class__._count += 1
        self.name = name
        self.data = []

    def reset(self):
        self.data[:] = []

    def add(self,*args):
        self.data.append(args)

    def onDrawText(self,*args):
        return '<onDraw name="%s" label="%s" />' % (self.name,encode_label(args))

    def __call__(self,canv,kind,label):
        self.add(*decode_label(label))

    def attachToPageTemplate(self,pt):
        if pt.onPage:
            def onPage(canv,doc,oop=pt.onPage):
                self.onPage(canv,doc)
                oop(canv,doc)
        else:
            def onPage(canv,doc):
                self.onPage(canv,doc)
        pt.onPage = onPage
        if pt.onPageEnd:
            def onPageEnd(canv,doc,oop=pt.onPageEnd):
                self.onPageEnd(canv,doc)
                oop(canv,doc)
        else:
            def onPageEnd(canv,doc):
                self.onPageEnd(canv,doc)
        pt.onPageEnd = onPageEnd

    def onPage(self,canv,doc):
        '''this will be called at the start of the page'''
        setattr(canv,self.name,self)    #push ourselves onto the canvas
        self.reset()

    def onPageEnd(self,canv,doc):
        '''this will be called at the end of a page'''
        self.pageEndAction(canv,doc)
        try:
            delattr(canv,self.name)
        except:
            pass
        self.reset()

    def pageEndAction(self,canv,doc):
        '''this should be overridden to do something useful'''
        pass

    def onDrawStr(self,value,*args):
        return onDrawStr(value,self,encode_label(args))

class BaseDocTemplate:
    """
    First attempt at defining a document template class.

    The basic idea is simple.

    1)  The document has a list of data associated with it
        this data should derive from flowables. We'll have
        special classes like PageBreak, FrameBreak to do things
        like forcing a page end etc.

    2)  The document has one or more page templates.

    3)  Each page template has one or more frames.

    4)  The document class provides base methods for handling the
        story events and some reasonable methods for getting the
        story flowables into the frames.

    5)  The document instances can override the base handler routines.

    Most of the methods for this class are not called directly by the user,
    but in some advanced usages they may need to be overridden via subclassing.

    EXCEPTION: doctemplate.build(...) must be called for most reasonable uses
    since it builds a document using the page template.

    Each document template builds exactly one document into a file specified
    by the filename argument on initialization.

    Possible keyword arguments for the initialization:

    - pageTemplates: A list of templates.  Must be nonempty.  Names
      assigned to the templates are used for referring to them so no two used
      templates should have the same name.  For example you might want one template
      for a title page, one for a section first page, one for a first page of
      a chapter and two more for the interior of a chapter on odd and even pages.
      If this argument is omitted then at least one pageTemplate should be provided
      using the addPageTemplates method before the document is built.
    - pageSize: a 2-tuple or a size constant from reportlab/lib/pagesizes.pu.
      Used by the SimpleDocTemplate subclass which does NOT accept a list of
      pageTemplates but makes one for you; ignored when using pageTemplates.

    - showBoundary: if set draw a box around the frame boundaries.
    - leftMargin:
    - rightMargin:
    - topMargin:
    - bottomMargin:  Margin sizes in points (default 1 inch).  These margins may be
      overridden by the pageTemplates.  They are primarily of interest for the
      SimpleDocumentTemplate subclass.

    - allowSplitting:  If set flowables (eg, paragraphs) may be split across frames or pages
      (default: 1)
    - title: Internal title for document (does not automatically display on any page)
    - author: Internal author for document (does not automatically display on any page)
    """
    _initArgs = {   'pagesize':defaultPageSize,
                    'pageTemplates':[],
                    'showBoundary':0,
                    'leftMargin':inch,
                    'rightMargin':inch,
                    'topMargin':inch,
                    'bottomMargin':inch,
                    'allowSplitting':1,
                    'title':None,
                    'author':None,
                    'subject':None,
                    'creator':None,
                    'keywords':[],
                    'invariant':None,
                    'pageCompression':None,
                    '_pageBreakQuick':1,
                    'rotation':0,
                    '_debug':0,
                    'encrypt': None,
                    'cropMarks': None,
                    'enforceColorSpace': None,
                    'displayDocTitle': None,
                    'lang': None,
                    'initialFontName': None,
                    'initialFontSize': None,
                    'initialLeading': None,
                    'cropBox': None,
                    'artBox': None,
                    'trimBox': None,
                    'bleedBox': None,
                    }
    _invalidInitArgs = ()
    _firstPageTemplateIndex = 0

    def __init__(self, filename, **kw):
        """create a document template bound to a filename (see class documentation for keyword arguments)"""
        self.filename = filename
        self._nameSpace = dict(doc=self)
        self._lifetimes = {}

        for k in self._initArgs.keys():
            if k not in kw:
                v = self._initArgs[k]
            else:
                if k in self._invalidInitArgs:
                    raise ValueError("Invalid argument %s" % k)
                v = kw[k]
            setattr(self,k,v)

        p = self.pageTemplates
        self.pageTemplates = []
        self.addPageTemplates(p)

        # facility to assist multi-build and cross-referencing.
        # various hooks can put things into here - key is what
        # you want, value is a page number.  This can then be
        # passed to indexing flowables.
        self._pageRefs = {}
        self._indexingFlowables = []

        #callback facility for progress monitoring
        self._onPage = None
        self._onProgress = None
        self._flowableCount = 0  # so we know how far to go

        #infinite loop detection if we start doing lots of empty pages
        self._curPageFlowableCount = 0
        self._emptyPages = 0
        self._emptyPagesAllowed = 10

        #context sensitive margins - set by story, not from outside
        self._leftExtraIndent = 0.0
        self._rightExtraIndent = 0.0
        self._topFlowables = []
        self._frameBGs = []

        self._calc()
        self.afterInit()

    def _calc(self):
        self._rightMargin = self.pagesize[0] - self.rightMargin
        self._topMargin = self.pagesize[1] - self.topMargin
        self.width = self._rightMargin - self.leftMargin
        self.height = self._topMargin - self.bottomMargin

    def setPageCallBack(self, func):
        'Simple progress monitor - func(pageNo) called on each new page'
        self._onPage = func

    def setProgressCallBack(self, func):
        '''Cleverer progress monitor - func(typ, value) called regularly'''
        self._onProgress = func

    def clean_hanging(self):
        'handle internal postponed actions'
        while len(self._hanging):
            self.handle_flowable(self._hanging)

    def addPageTemplates(self,pageTemplates):
        'add one or a sequence of pageTemplates'
        if not isSeq(pageTemplates):
            pageTemplates = [pageTemplates]
        #this test below fails due to inconsistent imports!
        #assert filter(lambda x: not isinstance(x,PageTemplate), pageTemplates)==[], "pageTemplates argument error"
        for t in pageTemplates:
            self.pageTemplates.append(t)

    def handle_documentBegin(self):
        '''implement actions at beginning of document'''
        self._hanging = [PageBegin]
        self.pageTemplate = self.pageTemplates[self._firstPageTemplateIndex]
        self.page = 0
        self.beforeDocument()

    def handle_pageBegin(self):
        """Perform actions required at beginning of page.
        shouldn't normally be called directly"""
        self.page += 1
        if self._debug: logger.debug("beginning page %d" % self.page)
        self.pageTemplate.beforeDrawPage(self.canv,self)
        self.pageTemplate.checkPageSize(self.canv,self)
        self.pageTemplate.onPage(self.canv,self)
        for f in self.pageTemplate.frames: f._reset()
        self.beforePage()
        #keep a count of flowables added to this page.  zero indicates bad stuff
        self._curPageFlowableCount = 0
        if hasattr(self,'_nextFrameIndex'):
            del self._nextFrameIndex
        self.frame = self.pageTemplate.frames[0]
        self.frame._debug = self._debug
        self.handle_frameBegin()

    def _setPageTemplate(self):
        if hasattr(self,'_nextPageTemplateCycle'):
            #they are cycling through pages'; we keep the index
            self.pageTemplate = self._nextPageTemplateCycle.next_value
        elif hasattr(self,'_nextPageTemplateIndex'):
            self.pageTemplate = self.pageTemplates[self._nextPageTemplateIndex]
            del self._nextPageTemplateIndex
        elif self.pageTemplate.autoNextPageTemplate:
            self.handle_nextPageTemplate(self.pageTemplate.autoNextPageTemplate)
            self.pageTemplate = self.pageTemplates[self._nextPageTemplateIndex]

    def _samePT(self,npt):
        if isSeq(npt):
            return getattr(self,'_nextPageTemplateCycle',[])
        if isinstance(npt,strTypes):
            return npt == (self.pageTemplates[self._nextPageTemplateIndex].id if hasattr(self,'_nextPageTemplateIndex') else self.pageTemplate.id)
        if isinstance(npt,int) and 0<=npt<len(self.pageTemplates):
            if hasattr(self,'_nextPageTemplateIndex'):
                return npt==self._nextPageTemplateIndex
            return npt==self.pageTemplates.find(self.pageTemplate)

    def handle_pageEnd(self):
        ''' show the current page
            check the next page template
            hang a page begin
        '''
        self._removeVars(('page','frame'))
        self._leftExtraIndent = self.frame._leftExtraIndent
        self._rightExtraIndent = self.frame._rightExtraIndent
        self._frameBGs = self.frame._frameBGs
        #detect infinite loops...
        if self._curPageFlowableCount == 0:
            self._emptyPages += 1
        else:
            self._emptyPages = 0
        if self._emptyPages >= self._emptyPagesAllowed:
            if 1:
                ident = "More than %d pages generated without content - halting layout.  Likely that a flowable is too large for any frame." % self._emptyPagesAllowed
                #leave to keep apart from the raise
                raise LayoutError(ident)
            else:
                pass    #attempt to restore to good state
        else:
            if self._onProgress:
                self._onProgress('PAGE', self.canv.getPageNumber())
            self.pageTemplate.afterDrawPage(self.canv, self)
            self.pageTemplate.onPageEnd(self.canv, self)
            self.afterPage()
            if self._debug: logger.debug("ending page %d" % self.page)
            self.canv.setPageRotation(getattr(self.pageTemplate,'rotation',self.rotation))
            self.canv.showPage()
            self._setPageTemplate()
            if self._emptyPages==0:
                pass    #store good state here
        self._hanging.append(PageBegin)

    def handle_pageBreak(self,slow=None):
        '''some might choose not to end all the frames'''
        if self._pageBreakQuick and not slow:
            self.handle_pageEnd()
        else:
            n = len(self._hanging)
            while len(self._hanging)==n:
                self.handle_frameEnd()

    def handle_frameBegin(self,resume=0):
        '''What to do at the beginning of a frame'''
        f = self.frame
        if f._atTop:
            if self.showBoundary or self.frame.showBoundary:
                self.frame.drawBoundary(self.canv)
        f._leftExtraIndent = self._leftExtraIndent
        f._rightExtraIndent = self._rightExtraIndent
        f._frameBGs = self._frameBGs
        if self._topFlowables:
            self._hanging.extend(self._topFlowables)

    def handle_frameEnd(self,resume=0):
        ''' Handles the semantics of the end of a frame. This includes the selection of
            the next frame or if this is the last frame then invoke pageEnd.
        '''
        self._removeVars(('frame',))
        self._leftExtraIndent = self.frame._leftExtraIndent
        self._rightExtraIndent = self.frame._rightExtraIndent
        self._frameBGs = self.frame._frameBGs

        f = self.frame
        if hasattr(self,'_nextFrameIndex'):
            self.frame = self.pageTemplate.frames[self._nextFrameIndex]
            self.frame._debug = self._debug
            del self._nextFrameIndex
            self.handle_frameBegin(resume)
        elif hasattr(f,'lastFrame') or f is self.pageTemplate.frames[-1]:
            self.handle_pageEnd()
            self.frame = None
        else:
            self.frame = self.pageTemplate.frames[self.pageTemplate.frames.index(f) + 1]
            self.frame._debug = self._debug
            self.handle_frameBegin()

    def handle_nextPageTemplate(self,pt):
        '''On endPage change to the page template with name or index pt'''
        if isinstance(pt,strTypes):
            if hasattr(self, '_nextPageTemplateCycle'): del self._nextPageTemplateCycle
            for t in self.pageTemplates:
                if t.id == pt:
                    self._nextPageTemplateIndex = self.pageTemplates.index(t)
                    return
            raise ValueError("can't find template('%s')"%pt)
        elif isinstance(pt,int):
            if hasattr(self, '_nextPageTemplateCycle'): del self._nextPageTemplateCycle
            self._nextPageTemplateIndex = pt
        elif isSeq(pt):
            #used for alternating left/right pages
            #collect the refs to the template objects, complain if any are bad
            c = PTCycle()
            for ptn in pt:
                found = 0
                if ptn=='*':    #special case name used to short circuit the iteration
                    c._restart = len(c)
                    continue
                for t in self.pageTemplates:
                    if t.id == ptn:
                        c.append(t)
                        found = 1
                if not found:
                    raise ValueError("Cannot find page template called %s" % ptn)
            if not c:
                raise ValueError("No valid page templates in cycle")
            elif c._restart>len(c):
                raise ValueError("Invalid cycle restart position")

            #ensure we start on the first one
            self._nextPageTemplateCycle = c
        else:
            raise TypeError("argument pt should be string or integer or list")

    def handle_nextFrame(self,fx,resume=0):
        '''On endFrame change to the frame with name or index fx'''
        if isinstance(fx,strTypes):
            for f in self.pageTemplate.frames:
                if f.id == fx:
                    self._nextFrameIndex = self.pageTemplate.frames.index(f)
                    return
            raise ValueError("can't find frame('%s') in %r(%s) which has frames %r"%(fx,self.pageTemplate,self.pageTemplate.id,[(f,f.id) for f in self.pageTemplate.frames]))
        elif isinstance(fx,int):
            self._nextFrameIndex = fx
        else:
            raise TypeError("argument fx should be string or integer")

    def handle_currentFrame(self,fx,resume=0):
        '''change to the frame with name or index fx'''
        self.handle_nextFrame(fx,resume)
        self.handle_frameEnd(resume)

    def handle_breakBefore(self, flowables):
        '''preprocessing step to allow pageBreakBefore and frameBreakBefore attributes'''
        first = flowables[0]
        # if we insert a page break before, we'll process that, see it again,
        # and go in an infinite loop.  So we need to set a flag on the object
        # saying 'skip me'.  This should be unset on the next pass
        if hasattr(first, '_skipMeNextTime'):
            delattr(first, '_skipMeNextTime')
            return
        # this could all be made much quicker by putting the attributes
        # in to the flowables with a defult value of 0
        if hasattr(first,'pageBreakBefore') and first.pageBreakBefore == 1:
            first._skipMeNextTime = 1
            first.insert(0, PageBreak())
            return
        if hasattr(first,'style') and hasattr(first.style, 'pageBreakBefore') and first.style.pageBreakBefore == 1:
            first._skipMeNextTime = 1
            flowables.insert(0, PageBreak())
            return
        if hasattr(first,'frameBreakBefore') and first.frameBreakBefore == 1:
            first._skipMeNextTime = 1
            flowables.insert(0, FrameBreak())
            return
        if hasattr(first,'style') and hasattr(first.style, 'frameBreakBefore') and first.style.frameBreakBefore == 1:
            first._skipMeNextTime = 1
            flowables.insert(0, FrameBreak())
            return

    def handle_keepWithNext(self, flowables):
        "implements keepWithNext"
        i = 0
        n = len(flowables)
        while i<n and flowables[i].getKeepWithNext(): i += 1
        if i:
            if i<n and not getattr(flowables[i],'locChanger',None): i += 1
            K = KeepTogether(flowables[:i])
            mbe = getattr(self,'_multiBuildEdits',None)
            if mbe:
                for f in K._content[:-1]:
                    if hasattr(f,'keepWithNext'):
                        mbe((setattr,f,'keepWithNext',f.keepWithNext))
                    else:
                        mbe((delattr,f,'keepWithNext')) #must get it from a style
                    f.__dict__['keepWithNext'] = 0
            else:
                for f in K._content[:-1]:
                    f.__dict__['keepWithNext'] = 0
            del flowables[:i]
            flowables.insert(0,K)

    def _fIdent(self,f,maxLen=None,frame=None):
        if frame: f._frame = frame
        try:
            return f.identity(maxLen)
        finally:
            if frame: del f._frame

    def handle_flowable(self,flowables):
        '''try to handle one flowable from the front of list flowables.'''

        #allow document a chance to look at, modify or ignore
        #the object(s) about to be processed
        self.filterFlowables(flowables)

        self.handle_breakBefore(flowables)
        self.handle_keepWithNext(flowables)
        f = flowables[0]
        del flowables[0]
        if f is None:
            return

        if isinstance(f,PageBreak):
            npt = f.nextTemplate
            if npt and not self._samePT(npt):
                npt=NextPageTemplate(npt)
                npt.apply(self)
                self.afterFlowable(npt)
            if isinstance(f,SlowPageBreak):
                self.handle_pageBreak(slow=1)
            else:
                self.handle_pageBreak()
            self.afterFlowable(f)
        elif isinstance(f,ActionFlowable):
            f.apply(self)
            self.afterFlowable(f)
        else:
            frame = self.frame
            canv = self.canv
            #try to fit it then draw it
            if frame.add(f, canv, trySplit=self.allowSplitting):
                if not isinstance(f,FrameActionFlowable):
                    self._curPageFlowableCount += 1
                    self.afterFlowable(f)
                _addGeneratedContent(flowables,frame)
            else:
                if self.allowSplitting:
                    # see if this is a splittable thing
                    S = frame.split(f,canv)
                    n = len(S)
                else:
                    n = 0
                if n:
                    if not isinstance(S[0],(PageBreak,SlowPageBreak,ActionFlowable,DDIndenter)):
                        if not frame.add(S[0], canv, trySplit=0):
                            ident = "Splitting error(n==%d) on page %d in\n%s\nS[0]=%s" % (n,self.page,self._fIdent(f,60,frame),self._fIdent(S[0],60,frame))
                            #leave to keep apart from the raise
                            raise LayoutError(ident)
                        self._curPageFlowableCount += 1
                        self.afterFlowable(S[0])
                        flowables[0:0] = S[1:]  # put rest of splitted flowables back on the list
                        _addGeneratedContent(flowables,frame)
                    else:
                        flowables[0:0] = S  # put splitted flowables back on the list
                else:
                    if hasattr(f,'_postponed'):
                        ident = "Flowable %s%s too large on page %d in frame %r%s of template %r" % \
                                (self._fIdent(f,60,frame),_fSizeString(f),self.page, self.frame.id,
                                        self.frame._aSpaceString(), self.pageTemplate.id)
                        #leave to keep apart from the raise
                        raise LayoutError(ident)
                    # this ought to be cleared when they are finally drawn!
                    f._postponed = 1
                    mbe = getattr(self,'_multiBuildEdits',None)
                    if mbe:
                        mbe((delattr,f,'_postponed'))
                    flowables.insert(0,f)           # put the flowable back
                    self.handle_frameEnd()

    #these are provided so that deriving classes can refer to them
    _handle_documentBegin = handle_documentBegin
    _handle_pageBegin = handle_pageBegin
    _handle_pageEnd = handle_pageEnd
    _handle_frameBegin = handle_frameBegin
    _handle_frameEnd = handle_frameEnd
    _handle_flowable = handle_flowable
    _handle_nextPageTemplate = handle_nextPageTemplate
    _handle_currentFrame = handle_currentFrame
    _handle_nextFrame = handle_nextFrame

    def _startBuild(self, filename=None, canvasmaker=canvas.Canvas):
        self._calc()

        #each distinct pass gets a sequencer
        self.seq = reportlab.lib.sequencer.Sequencer()

        self.canv = canvasmaker(filename or self.filename,
                                pagesize=self.pagesize,
                                invariant=self.invariant,
                                pageCompression=self.pageCompression,
                                enforceColorSpace=self.enforceColorSpace,
                                initialFontName = self.initialFontName,
                                initialFontSize = self.initialFontSize,
                                initialLeading = self.initialLeading,
                                cropBox = self.cropBox,
                                artBox = self.artBox,
                                trimBox = self.trimBox,
                                bleedBox = self.bleedBox,
                                )

        getattr(self.canv,'setEncrypt',lambda x: None)(self.encrypt)

        self.canv._cropMarks = self.cropMarks
        self.canv.setAuthor(self.author)
        self.canv.setTitle(self.title)
        self.canv.setSubject(self.subject)
        self.canv.setCreator(self.creator)
        self.canv.setKeywords(self.keywords)
        if self.displayDocTitle is not None:
            self.canv.setViewerPreference('DisplayDocTitle',['false','true'][self.displayDocTitle])
        if self.lang:
            self.canv.setCatalogEntry('Lang',self.lang)

        if self._onPage:
            self.canv.setPageCallBack(self._onPage)
        self.handle_documentBegin()

    def _endBuild(self):
        self._removeVars(('build','page','frame'))
        if self._hanging!=[] and self._hanging[-1] is PageBegin:
            del self._hanging[-1]
            self.clean_hanging()
        else:
            self.clean_hanging()
            self.handle_pageBreak()

        if getattr(self,'_doSave',1): self.canv.save()
        if self._onPage: self.canv.setPageCallBack(None)

    def build(self, flowables, filename=None, canvasmaker=canvas.Canvas):
        """Build the document from a list of flowables.
           If the filename argument is provided then that filename is used
           rather than the one provided upon initialization.
           If the canvasmaker argument is provided then it will be used
           instead of the default.  For example a slideshow might use
           an alternate canvas which places 6 slides on a page (by
           doing translations, scalings and redefining the page break
           operations).
        """
        #assert filter(lambda x: not isinstance(x,Flowable), flowables)==[], "flowables argument error"
        flowableCount = len(flowables)
        if self._onProgress:
            self._onProgress('STARTED',0)
            self._onProgress('SIZE_EST', len(flowables))
        self._startBuild(filename,canvasmaker)

        #pagecatcher can drag in information from embedded PDFs and we want ours
        #to take priority, so cache and reapply our own info dictionary after the build.
        canv = self.canv
        self._savedInfo = canv._doc.info
        handled = 0

        try:
            canv._doctemplate = self
            while len(flowables):
                if self._hanging and self._hanging[-1] is PageBegin and isinstance(flowables[0],PageBreakIfNotEmpty):
                    npt = flowables[0].nextTemplate
                    if npt and not self._samePT(npt):
                        npt=NextPageTemplate(npt)
                        npt.apply(self)
                        self._setPageTemplate()
                    del flowables[0]
                self.clean_hanging()
                try:
                    first = flowables[0]
                    self.handle_flowable(flowables)
                    handled += 1
                except:
                    #if it has trace info, add it to the traceback message.
                    if hasattr(first, '_traceInfo') and first._traceInfo:
                        exc = sys.exc_info()[1]
                        args = list(exc.args)
                        tr = first._traceInfo
                        args[0] += '\n(srcFile %s, line %d char %d to line %d char %d)' % (
                            tr.srcFile,
                            tr.startLineNo,
                            tr.startLinePos,
                            tr.endLineNo,
                            tr.endLinePos
                            )
                        exc.args = tuple(args)
                    raise
                if self._onProgress:
                    self._onProgress('PROGRESS',flowableCount - len(flowables))
        finally:
            del canv._doctemplate


        #reapply pagecatcher info
        canv._doc.info = self._savedInfo

        self._endBuild()
        if self._onProgress:
            self._onProgress('FINISHED',0)

    def _allSatisfied(self):
        """Called by multi-build - are all cross-references resolved?"""
        allHappy = 1
        for f in self._indexingFlowables:
            if not f.isSatisfied():
                allHappy = 0
                break
        return allHappy

    def notify(self, kind, stuff):
        """Forward to any listeners"""
        for l in self._indexingFlowables:
            _canv = getattr(l,'_canv',self)
            try:
                if _canv==self:
                    l._canv = self.canv
                l.notify(kind, stuff)
            finally:
                if _canv==self:
                    del l._canv

    def pageRef(self, label):
        """hook to register a page number"""
        if verbose: print("pageRef called with label '%s' on page %d" % (
            label, self.page))
        self._pageRefs[label] = self.page

    def multiBuild(self, story,
                   maxPasses = 10,
                   **buildKwds
                   ):
        """Makes multiple passes until all indexing flowables
        are happy.

        Returns number of passes"""
        self._indexingFlowables = []
        #scan the story and keep a copy
        for thing in story:
            if thing.isIndexing():
                self._indexingFlowables.append(thing)

        #better fix for filename is a 'file' problem
        self._doSave = 0
        passes = 0
        mbe = []
        self._multiBuildEdits = mbe.append
        while 1:
            passes += 1
            if self._onProgress:
                self._onProgress('PASS', passes)
            if verbose: sys.stdout.write('building pass '+str(passes) + '...')

            for fl in self._indexingFlowables:
                fl.beforeBuild()

            # work with a copy of the story, since it is consumed
            tempStory = story[:]
            self.build(tempStory, **buildKwds)
            #self.notify('debug',None)

            for fl in self._indexingFlowables:
                fl.afterBuild()

            happy = self._allSatisfied()

            if happy:
                self._doSave = 0
                self.canv.save()
                break
            if passes > maxPasses:
                raise IndexError("Index entries not resolved after %d passes" % maxPasses)

            #work through any edits
            while mbe:
                e = mbe.pop(0)
                e[0](*e[1:])

        del self._multiBuildEdits
        if verbose: print('saved')
        return passes

    #these are pure virtuals override in derived classes
    #NB these get called at suitable places by the base class
    #so if you derive and override the handle_xxx methods
    #it's up to you to ensure that they maintain the needed consistency
    def afterInit(self):
        """This is called after initialisation of the base class."""
        pass

    def beforeDocument(self):
        """This is called before any processing is
        done on the document."""
        pass

    def beforePage(self):
        """This is called at the beginning of page
        processing, and immediately before the
        beforeDrawPage method of the current page
        template."""
        pass

    def afterPage(self):
        """This is called after page processing, and
        immediately after the afterDrawPage method
        of the current page template."""
        pass

    def filterFlowables(self,flowables):
        '''called to filter flowables at the start of the main handle_flowable method.
        Upon return if flowables[0] has been set to None it is discarded and the main
        method returns.
        '''
        pass

    def afterFlowable(self, flowable):
        '''called after a flowable has been rendered'''
        pass

    _allowedLifetimes = 'page','frame','build','forever'
    def docAssign(self,var,expr,lifetime):
        if not isinstance(expr,strTypes): expr=str(expr)
        expr=expr.strip()
        var=var.strip()
        self.docExec('%s=(%s)'%(var.strip(),expr.strip()),lifetime)

    def docExec(self,stmt,lifetime):
        stmt=stmt.strip()
        NS=self._nameSpace
        K0=list(NS.keys())
        try:
            if lifetime not in self._allowedLifetimes:
                raise ValueError('bad lifetime %r not in %r'%(lifetime,self._allowedLifetimes))
            exec(stmt, {},NS)
        except:
            exc = sys.exc_info()[1]
            args = list(exc.args)
            msg = '\ndocExec %s lifetime=%r failed!' % (stmt,lifetime)
            args.append(msg)
            exc.args = tuple(args)
            for k in NS.keys():
                if k not in K0:
                    del NS[k]
            raise
        self._addVars([k for k in NS.keys() if k not in K0],lifetime)

    def _addVars(self,vars,lifetime):
        '''add namespace variables to lifetimes lists'''
        LT=self._lifetimes
        for var in vars:
            for v in LT.values():
                if var in v:
                    v.remove(var)
            LT.setdefault(lifetime,set([])).add(var)

    def _removeVars(self,lifetimes):
        '''remove namespace variables for with lifetime in lifetimes'''
        LT=self._lifetimes
        NS=self._nameSpace
        for lifetime in lifetimes:
            for k in LT.setdefault(lifetime,[]):
                try:
                    del NS[k]
                except KeyError:
                    pass
            del LT[lifetime]

    def docEval(self,expr):
        try:
            return eval(expr.strip(),{},self._nameSpace)
        except:
            exc = sys.exc_info()[1]
            args = list(exc.args)
            args[-1] += '\ndocEval %s failed!' % expr
            exc.args = tuple(args)
            raise

class SimpleDocTemplate(BaseDocTemplate):
    """A special case document template that will handle many simple documents.
       See documentation for BaseDocTemplate.  No pageTemplates are required
       for this special case.   A page templates are inferred from the
       margin information and the onFirstPage, onLaterPages arguments to the build method.

       A document which has all pages with the same look except for the first
       page may can be built using this special approach.
    """
    _invalidInitArgs = ('pageTemplates',)

    def handle_pageBegin(self):
        '''override base method to add a change of page template after the firstpage.
        '''
        self._handle_pageBegin()
        self._handle_nextPageTemplate('Later')

    def build(self,flowables,onFirstPage=_doNothing, onLaterPages=_doNothing, canvasmaker=canvas.Canvas):
        """build the document using the flowables.  Annotate the first page using the onFirstPage
               function and later pages using the onLaterPages function.  The onXXX pages should follow
               the signature

                  def myOnFirstPage(canvas, document):
                      # do annotations and modify the document
                      ...

               The functions can do things like draw logos, page numbers,
               footers, etcetera. They can use external variables to vary
               the look (for example providing page numbering or section names).
        """
        self._calc()    #in case we changed margins sizes etc
        frameT = Frame(self.leftMargin, self.bottomMargin, self.width, self.height, id='normal')
        self.addPageTemplates([PageTemplate(id='First',frames=frameT, onPage=onFirstPage,pagesize=self.pagesize),
                        PageTemplate(id='Later',frames=frameT, onPage=onLaterPages,pagesize=self.pagesize)])
        if onFirstPage is _doNothing and hasattr(self,'onFirstPage'):
            self.pageTemplates[0].beforeDrawPage = self.onFirstPage
        if onLaterPages is _doNothing and hasattr(self,'onLaterPages'):
            self.pageTemplates[1].beforeDrawPage = self.onLaterPages
        BaseDocTemplate.build(self,flowables, canvasmaker=canvasmaker)

def progressCB(typ, value):
    """Example prototype for progress monitoring.

    This aims to provide info about what is going on
    during a big job.  It should enable, for example, a reasonably
    smooth progress bar to be drawn.  We design the argument
    signature to be predictable and conducive to programming in
    other (type safe) languages.  If set, this will be called
    repeatedly with pairs of values.  The first is a string
    indicating the type of call; the second is a numeric value.

    typ 'STARTING', value = 0
    typ 'SIZE_EST', value = numeric estimate of job size
    typ 'PASS', value = number of this rendering pass
    typ 'PROGRESS', value = number between 0 and SIZE_EST
    typ 'PAGE', value = page number of page
    type 'FINISHED', value = 0

    The sequence is
        STARTING - always called once
        SIZE_EST - always called once
        PROGRESS - called often
        PAGE - called often when page is emitted
        FINISHED - called when really, really finished

    some juggling is needed to accurately estimate numbers of
    pages in pageDrawing mode.

    NOTE: the SIZE_EST is a guess.  It is possible that the
    PROGRESS value may slightly exceed it, or may even step
    back a little on rare occasions.  The only way to be
    really accurate would be to do two passes, and I don't
    want to take that performance hit.
    """
    print('PROGRESS MONITOR:  %-10s   %d' % (typ, value))

if __name__ == '__main__':
    from reportlab.lib.styles import _baseFontName, _baseFontNameB
    def myFirstPage(canvas, doc):
        from reportlab.lib.colors import red
        PAGE_HEIGHT = canvas._pagesize[1]
        canvas.saveState()
        canvas.setStrokeColor(red)
        canvas.setLineWidth(5)
        canvas.line(66,72,66,PAGE_HEIGHT-72)
        canvas.setFont(_baseFontNameB,24)
        canvas.drawString(108, PAGE_HEIGHT-108, "TABLE OF CONTENTS DEMO")
        canvas.setFont(_baseFontName,12)
        canvas.drawString(4 * inch, 0.75 * inch, "First Page")
        canvas.restoreState()

    def myLaterPages(canvas, doc):
        from reportlab.lib.colors import red
        PAGE_HEIGHT = canvas._pagesize[1]
        canvas.saveState()
        canvas.setStrokeColor(red)
        canvas.setLineWidth(5)
        canvas.line(66,72,66,PAGE_HEIGHT-72)
        canvas.setFont(_baseFontName,12)
        canvas.drawString(4 * inch, 0.75 * inch, "Page %d" % doc.page)
        canvas.restoreState()

    def run():
        objects_to_draw = []
        from reportlab.lib.styles import ParagraphStyle
        #from paragraph import Paragraph
        from reportlab.platypus.doctemplate import SimpleDocTemplate

        #need a style
        normal = ParagraphStyle('normal')
        normal.firstLineIndent = 18
        normal.spaceBefore = 6
        from reportlab.lib.randomtext import randomText
        import random
        for i in range(15):
            height = 0.5 + (2*random.random())
            box = XBox(6 * inch, height * inch, 'Box Number %d' % i)
            objects_to_draw.append(box)
            para = Paragraph(randomText(), normal)
            objects_to_draw.append(para)

        SimpleDocTemplate('doctemplate.pdf').build(objects_to_draw,
            onFirstPage=myFirstPage,onLaterPages=myLaterPages)

    run()
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     #Copyright ReportLab Europe Ltd. 2000-2016
#see license.txt for license details
#history http://www.reportlab.co.uk/cgi-bin/viewcvs.cgi/public/reportlab/trunk/reportlab/platypus/figures.py
"""This includes some demos of platypus for use in the API proposal"""
__version__='3.3.0'

import os

from reportlab.lib import colors
from reportlab.pdfgen.canvas import Canvas
from reportlab.lib.styles import ParagraphStyle
from reportlab.lib.utils import recursiveImport, strTypes
from reportlab.platypus import Frame
from reportlab.platypus import Flowable
from reportlab.platypus import Paragraph
from reportlab.lib.units import inch
from reportlab.lib.enums import TA_LEFT, TA_RIGHT, TA_CENTER
from reportlab.lib.validators import isColor
from reportlab.lib.colors import toColor
from reportlab.lib.styles import _baseFontName, _baseFontNameI

captionStyle = ParagraphStyle('Caption', fontName=_baseFontNameI, fontSize=10, alignment=TA_CENTER)

class Figure(Flowable):
    def __init__(self, width, height, caption="",
                 captionFont=_baseFontNameI, captionSize=12,
                 background=None,
                 captionTextColor=toColor('black'),
                 captionBackColor=None,
                 border=None,
                 spaceBefore=12,
                 spaceAfter=12,
                 captionGap=None,
                 captionAlign='centre',
                 captionPosition='bottom',
                 hAlign='CENTER',
                 ):
        Flowable.__init__(self)
        self.width = width
        self.figureHeight = height
        self.caption = caption
        self.captionFont = captionFont
        self.captionSize = captionSize
        self.captionTextColor = captionTextColor
        self.captionBackColor = captionBackColor
        self.captionGap = captionGap or 0.5*captionSize
        self.captionAlign = captionAlign
        self.captionPosition = captionPosition
        self._captionData = None
        self.captionHeight = 0  # work out later
        self.background = background
        self.border = border
        self.spaceBefore = spaceBefore
        self.spaceAfter = spaceAfter
        self.hAlign=hAlign
        self._getCaptionPara()  #Larry Meyn's fix - otherwise they all get the number of the last chapter.

    def _getCaptionPara(self):
        caption = self.caption
        captionFont = self.captionFont
        captionSize = self.captionSize
        captionTextColor = self.captionTextColor
        captionBackColor = self.captionBackColor
        captionAlign = self.captionAlign
        captionPosition = self.captionPosition
        if self._captionData!=(caption,captionFont,captionSize,captionTextColor,captionBackColor,captionAlign,captionPosition):
            self._captionData = (caption,captionFont,captionSize,captionTextColor,captionBackColor,captionAlign,captionPosition)
            if isinstance(caption,Paragraph):
                self.captionPara = caption
            elif isinstance(caption,strTypes):
                self.captionStyle = ParagraphStyle(
                    'Caption',
                    fontName=captionFont,
                    fontSize=captionSize,
                    leading=1.2*captionSize,
                    textColor = captionTextColor,
                    backColor = captionBackColor,
                    #seems to be getting ignored
                    spaceBefore=self.captionGap,
                    alignment=TA_LEFT if captionAlign=='left' else TA_RIGHT if captionAlign=='right' else TA_CENTER,
                    )
                #must build paragraph now to get sequencing in synch with rest of story
                self.captionPara = Paragraph(self.caption, self.captionStyle)
            else:
                raise ValueError('Figure caption of type %r is not a string or Paragraph' % type(caption))

    def wrap(self, availWidth, availHeight):
        # try to get the caption aligned
        if self.caption:
            self._getCaptionPara()
            w, h = self.captionPara.wrap(self.width, availHeight - self.figureHeight)
            self.captionHeight = h + self.captionGap
            self.height = self.captionHeight + self.figureHeight
            if w>self.width: self.width = w
        else:
            self.height = self.figureHeight
        if self.hAlign in ('CENTER','CENTRE',TA_CENTER):
            self.dx = 0.5 * (availWidth - self.width)
        elif self.hAlign in ('RIGHT',TA_RIGHT):
            self.dx = availWidth - self.width
        else:
            self.dx = 0
        return (self.width, self.height)

    def draw(self):
        self.canv.translate(self.dx, 0)
        if self.caption and self.captionPosition=='bottom':
            self.canv.translate(0, self.captionHeight)
        if self.background:
            self.drawBackground()
        if self.border:
            self.drawBorder()
        self.canv.saveState()
        self.drawFigure()
        self.canv.restoreState()
        if self.caption:
            if self.captionPosition=='bottom':
                self.canv.translate(0, -self.captionHeight)
            else:
                self.canv.translate(0, self.figureHeight+self.captionGap)
            self._getCaptionPara()
            self.drawCaption()

    def drawBorder(self):
        canv = self.canv
        border = self.border
        bc = getattr(border,'color',None)
        bw = getattr(border,'width',None)
        bd = getattr(border,'dashArray',None)
        ss = bc or bw or bd
        if ss:
            canv.saveState()
            if bc: canv.setStrokeColor(bc)
            if bw: canv.setLineWidth(bw)
            if bd: canv.setDash(bd)
        canv.rect(0, 0, self.width, self.figureHeight,fill=0,stroke=1)
        if ss:
            canv.restoreState()

    def _doBackground(self, color):
        self.canv.saveState()
        self.canv.setFillColor(self.background)
        self.canv.rect(0, 0, self.width, self.figureHeight, fill=1)
        self.canv.restoreState()

    def drawBackground(self):
        """For use when using a figure on a differently coloured background.
        Allows you to specify a colour to be used as a background for the figure."""
        if isColor(self.background):
            self._doBackground(self.background)
        else:
            try:
                c = toColor(self.background)
                self._doBackground(c)
            except:
                pass

    def drawCaption(self):
        self.captionPara.drawOn(self.canv, 0, 0)

    def drawFigure(self):
        pass

def drawPage(canvas,x, y, width, height):
    #draws something which looks like a page
    pth = canvas.beginPath()
    corner = 0.05*width

    # shaded backdrop offset a little
    canvas.setFillColorRGB(0.5,0.5,0.5)
    canvas.rect(x + corner, y - corner, width, height, stroke=0, fill=1)

    #'sheet of paper' in light yellow
    canvas.setFillColorRGB(1,1,0.9)
    canvas.setLineWidth(0)
    canvas.rect(x, y, width, height, stroke=1, fill=1)

    #reset
    canvas.setFillColorRGB(0,0,0)
    canvas.setStrokeColorRGB(0,0,0)

class PageFigure(Figure):
    """Shows a blank page in a frame, and draws on that.  Used in
    illustrations of how PLATYPUS works."""
    def __init__(self, background=None):
        Figure.__init__(self, 3*inch, 3*inch)
        self.caption = 'Figure 1 - a blank page'
        self.captionStyle = captionStyle
        self.background = background

    def drawVirtualPage(self):
        pass

    def drawFigure(self):
        drawPage(self.canv, 0.625*inch, 0.25*inch, 1.75*inch, 2.5*inch)
        self.canv.translate(0.625*inch, 0.25*inch)
        self.canv.scale(1.75/8.27, 2.5/11.69)
        self.drawVirtualPage()

class PlatPropFigure1(PageFigure):
    """This shows a page with a frame on it"""
    def __init__(self):
        PageFigure.__init__(self)
        self.caption = "Figure 1 - a page with a simple frame"
    def drawVirtualPage(self):
        demo1(self.canv)

class FlexFigure(Figure):
    """Base for a figure class with a caption. Can grow or shrink in proportion"""
    def __init__(self, width, height, caption, background=None,
                        captionFont='Helvetica-Oblique',captionSize=8,
                        captionTextColor=colors.black,
                        shrinkToFit=1,
                        growToFit=1,
                        spaceBefore=12,
                        spaceAfter=12,
                        captionGap=9,
                        captionAlign='centre',
                        captionPosition='top',
                        scaleFactor=None,
                        hAlign='CENTER',
                        border=1,
                        ):
        Figure.__init__(self, width, height, caption,
                        captionFont=captionFont,
                        captionSize=captionSize,
                        background=None,
                        captionTextColor=captionTextColor,
                        spaceBefore = spaceBefore,
                        spaceAfter = spaceAfter,
                        captionGap=captionGap,
                        captionAlign=captionAlign,
                        captionPosition=captionPosition,
                        hAlign=hAlign,
                        border=border,
                        )
        self.shrinkToFit = shrinkToFit  #if set and wrap is too tight, shrinks
        self.growToFit = growToFit      #if set and wrap is too small, grows
        self.scaleFactor = scaleFactor
        self._scaleFactor = None
        self.background = background

    def _scale(self,availWidth,availHeight):
        "Rescale to fit according to the rules, but only once"
        if self._scaleFactor is None or self.width>availWidth or self.height>availHeight:
            w, h = Figure.wrap(self, availWidth, availHeight)
            captionHeight = h - self.figureHeight
            if self.scaleFactor is None:
                #scale factor None means auto
                self._scaleFactor = min(availWidth/self.width,(availHeight-captionHeight)/self.figureHeight)
            else: #they provided a factor
                self._scaleFactor = self.scaleFactor
            if self._scaleFactor<1 and self.shrinkToFit:
                self.width = self.width * self._scaleFactor - 0.0001
                self.figureHeight = self.figureHeight * self._scaleFactor
            elif self._scaleFactor>1 and self.growToFit:
                self.width = self.width*self._scaleFactor - 0.0001
                self.figureHeight = self.figureHeight * self._scaleFactor

    def wrap(self, availWidth, availHeight):
        self._scale(availWidth,availHeight)
        return Figure.wrap(self, availWidth, availHeight)

    def split(self, availWidth, availHeight):
        self._scale(availWidth,availHeight)
        return Figure.split(self, availWidth, availHeight)

class ImageFigure(FlexFigure):
    """Image with a caption below it"""
    def __init__(self, filename, caption, background=None,scaleFactor=None,hAlign='CENTER',border=None):
        assert os.path.isfile(filename), 'image file %s not found' % filename
        from reportlab.lib.utils import ImageReader
        w, h = ImageReader(filename).getSize()
        self.filename = filename
        FlexFigure.__init__(self, w, h, caption, background,scaleFactor=scaleFactor,hAlign=hAlign,border=border)

    def drawFigure(self):
        self.canv.drawImage(self.filename,
                                  0, 0,self.width, self.figureHeight)

class DrawingFigure(FlexFigure):
    """Drawing with a caption below it.  Clunky, scaling fails."""
    def __init__(self, modulename, classname, caption, baseDir=None, background=None):
        module = recursiveImport(modulename, baseDir)
        klass = getattr(module, classname)
        self.drawing = klass()
        FlexFigure.__init__(self,
                            self.drawing.width,
                            self.drawing.height,
                            caption,
                            background)
        self.growToFit = 1

    def drawFigure(self):
        self.canv.scale(self._scaleFactor, self._scaleFactor)
        self.drawing.drawOn(self.canv, 0, 0)

try:
    from rlextra.pageCatcher.pageCatcher import restoreForms, storeForms, storeFormsInMemory, restoreFormsInMemory
    _hasPageCatcher = 1
except ImportError:
    _hasPageCatcher = 0
if _hasPageCatcher:
    ####################################################################
    #
    #    PageCatcher plugins
    # These let you use our PageCatcher product to add figures
    # to other documents easily.
    ####################################################################
    class PageCatcherCachingMixIn:
        "Helper functions to cache pages for figures"

        def getFormName(self, pdfFileName, pageNo):
            #naming scheme works within a directory only
            dirname, filename = os.path.split(pdfFileName)
            root, ext = os.path.splitext(filename)
            return '%s_page%d' % (root, pageNo)

        def needsProcessing(self, pdfFileName, pageNo):
            "returns 1 if no forms or form is older"
            formName = self.getFormName(pdfFileName, pageNo)
            if os.path.exists(formName + '.frm'):
                formModTime = os.stat(formName + '.frm')[8]
                pdfModTime = os.stat(pdfFileName)[8]
                return (pdfModTime > formModTime)
            else:
                return 1

        def processPDF(self, pdfFileName, pageNo):
            formName = self.getFormName(pdfFileName, pageNo)
            storeForms(pdfFileName, formName + '.frm',
                                    prefix= formName + '_',
                                    pagenumbers=[pageNo])
            #print 'stored %s.frm' % formName
            return formName + '.frm'

    class cachePageCatcherFigureNonA4(FlexFigure, PageCatcherCachingMixIn):
        """PageCatcher page with a caption below it.  Size to be supplied."""
        # This should merge with PageFigure into one class that reuses
        # form information to determine the page orientation...
        def __init__(self, filename, pageNo, caption, width, height, background=None):
            self.dirname, self.filename = os.path.split(filename)
            if self.dirname == '':
                self.dirname = os.curdir
            self.pageNo = pageNo
            self.formName = self.getFormName(self.filename, self.pageNo) + '_' + str(pageNo)
            FlexFigure.__init__(self, width, height, caption, background)

        def drawFigure(self):
            self.canv.saveState()
            if not self.canv.hasForm(self.formName):
                restorePath = self.dirname + os.sep + self.filename
                #does the form file exist?  if not, generate it.
                formFileName = self.getFormName(restorePath, self.pageNo) + '.frm'
                if self.needsProcessing(restorePath, self.pageNo):
                    #print 'preprocessing PDF %s page %s' % (restorePath, self.pageNo)
                    self.processPDF(restorePath, self.pageNo)
                names = restoreForms(formFileName, self.canv)
            self.canv.scale(self._scaleFactor, self._scaleFactor)
            self.canv.doForm(self.formName)
            self.canv.restoreState()

    class cachePageCatcherFigure(cachePageCatcherFigureNonA4):
        """PageCatcher page with a caption below it.  Presumes A4, Portrait.
        This needs our commercial PageCatcher product, or you'll get a blank."""
        def __init__(self, filename, pageNo, caption, width=595, height=842, background=None):
            cachePageCatcherFigureNonA4.__init__(self, filename, pageNo, caption, width, height, background=background)

    class PageCatcherFigureNonA4(FlexFigure):
        """PageCatcher page with a caption below it.  Size to be supplied."""
        # This should merge with PageFigure into one class that reuses
        # form information to determine the page orientation...
        _cache = {}
        def __init__(self, filename, pageNo, caption, width, height, background=None, caching=None):
            fn = self.filename = filename
            self.pageNo = pageNo
            fn = fn.replace(os.sep,'_').replace('/','_').replace('\\','_').replace('-','_').replace(':','_')
            self.prefix = fn.replace('.','_')+'_'+str(pageNo)+'_'
            self.formName = self.prefix + str(pageNo)
            self.caching = caching
            FlexFigure.__init__(self, width, height, caption, background)

        def drawFigure(self):
            if not self.canv.hasForm(self.formName):
                if self.filename in self._cache:
                    f,data = self._cache[self.filename]
                else:
                    f = open(self.filename,'rb')
                    pdf = f.read()
                    f.close()
                    f, data = storeFormsInMemory(pdf, pagenumbers=[self.pageNo], prefix=self.prefix)
                    if self.caching=='memory':
                        self._cache[self.filename] = f, data
                f = restoreFormsInMemory(data, self.canv)
            self.canv.saveState()
            self.canv.scale(self._scaleFactor, self._scaleFactor)
            self.canv.doForm(self.formName)
            self.canv.restoreState()

    class PageCatcherFigure(PageCatcherFigureNonA4):
        """PageCatcher page with a caption below it.  Presumes A4, Portrait.
        This needs our commercial PageCatcher product, or you'll get a blank."""
        def __init__(self, filename, pageNo, caption, width=595, height=842, background=None, caching=None):
            PageCatcherFigureNonA4.__init__(self, filename, pageNo, caption, width, height, background=background, caching=caching)

def demo1(canvas):
    frame = Frame(
                    2*inch,     # x
                    4*inch,     # y at bottom
                    4*inch,     # width
                    5*inch,     # height
                    showBoundary = 1  # helps us see what's going on
                    )
    bodyStyle = ParagraphStyle('Body', fontName=_baseFontName, fontSize=24, leading=28, spaceBefore=6)
    para1 = Paragraph('Spam spam spam spam. ' * 5, bodyStyle)
    para2 = Paragraph('Eggs eggs eggs. ' * 5, bodyStyle)
    mydata = [para1, para2]

    #this does the packing and drawing.  The frame will consume
    #items from the front of the list as it prints them
    frame.addFromList(mydata,canvas)

def test1():
    c  = Canvas('figures.pdf')
    f = Frame(inch, inch, 6*inch, 9*inch, showBoundary=1)
    v = PlatPropFigure1()
    v.captionTextColor = toColor('blue')
    v.captionBackColor = toColor('lightyellow')
    f.addFromList([v],c)
    c.save()

if __name__ == '__main__':
    test1()
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          #Copyright ReportLab Europe Ltd. 2000-2016
#see license.txt for license details
#history http://www.reportlab.co.uk/cgi-bin/viewcvs.cgi/public/reportlab/trunk/reportlab/platypus/flowables.py
__version__='3.3.0'
__doc__="""
A flowable is a "floating element" in a document whose exact position is determined by the
other elements that precede it, such as a paragraph, a diagram interspersed between paragraphs,
a section header, etcetera.  Examples of non-flowables include page numbering annotations,
headers, footers, fixed diagrams or logos, among others.

Flowables are defined here as objects which know how to determine their size and which
can draw themselves onto a page with respect to a relative "origin" position determined
at a higher level. The object's draw() method should assume that (0,0) corresponds to the
bottom left corner of the enclosing rectangle that will contain the object. The attributes
vAlign and hAlign may be used by 'packers' as hints as to how the object should be placed.

Some Flowables also know how to "split themselves".  For example a
long paragraph might split itself between one page and the next.

Packers should set the canv attribute during wrap, split & draw operations to allow
the flowable to work out sizes etc in the proper context.

The "text" of a document usually consists mainly of a sequence of flowables which
flow into a document from top to bottom (with column and page breaks controlled by
higher level components).
"""
import os
from copy import deepcopy, copy
from reportlab.lib.colors import red, gray, lightgrey
from reportlab.lib.rl_accel import fp_str
from reportlab.lib.enums import TA_LEFT, TA_CENTER, TA_RIGHT, TA_JUSTIFY
from reportlab.lib.styles import _baseFontName
from reportlab.lib.utils import strTypes
from reportlab.pdfbase import pdfutils
from reportlab.pdfbase.pdfmetrics import stringWidth
from reportlab.rl_config import _FUZZ, overlapAttachedSpace, ignoreContainerActions, listWrapOnFakeWidth
import collections

__all__=('TraceInfo','Flowable','XBox','Preformatted','Image','Spacer','PageBreak','SlowPageBreak',
        'CondPageBreak','KeepTogether','Macro','CallerMacro','ParagraphAndImage',
        'FailOnWrap','HRFlowable','PTOContainer','KeepInFrame','UseUpSpace',
        'ListFlowable','ListItem','DDIndenter','LIIndenter',
        'DocAssign', 'DocExec', 'DocAssert', 'DocPara', 'DocIf', 'DocWhile',
        'PageBreakIfNotEmpty',
        )
class TraceInfo:
    "Holder for info about where an object originated"
    def __init__(self):
        self.srcFile = '(unknown)'
        self.startLineNo = -1
        self.startLinePos = -1
        self.endLineNo = -1
        self.endLinePos = -1

#############################################################
#   Flowable Objects - a base class and a few examples.
#   One is just a box to get some metrics.  We also have
#   a paragraph, an image and a special 'page break'
#   object which fills the space.
#############################################################
class Flowable:
    """Abstract base class for things to be drawn.  Key concepts:
    
    1. It knows its size
    2. It draws in its own coordinate system (this requires the
       base API to provide a translate() function.
    
    """
    _fixedWidth = 0         #assume wrap results depend on arguments?
    _fixedHeight = 0

    def __init__(self):
        self.width = 0
        self.height = 0
        self.wrapped = 0

        #these are hints to packers/frames as to how the floable should be positioned
        self.hAlign = 'LEFT'    #CENTER/CENTRE or RIGHT
        self.vAlign = 'BOTTOM'  #MIDDLE or TOP

        #optional holder for trace info
        self._traceInfo = None
        self._showBoundary = None

        #many flowables handle text and must be processed in the
        #absence of a canvas.  tagging them with their encoding
        #helps us to get conversions right.  Use Python codec names.
        self.encoding = None

    def _drawOn(self,canv):
        '''ensure canv is set on and then draw'''
        self.canv = canv
        self.draw()#this is the bit you overload
        del self.canv

    def _hAlignAdjust(self,x,sW=0):
        if sW and hasattr(self,'hAlign'):
            a = self.hAlign
            if a in ('CENTER','CENTRE', TA_CENTER):
                x += 0.5*sW
            elif a in ('RIGHT',TA_RIGHT):
                x += sW
            elif a not in ('LEFT',TA_LEFT):
                raise ValueError("Bad hAlign value "+str(a))
        return x

    def drawOn(self, canvas, x, y, _sW=0):
        "Tell it to draw itself on the canvas.  Do not override"
        x = self._hAlignAdjust(x,_sW)
        canvas.saveState()
        canvas.translate(x, y)
        self._drawOn(canvas)
        if hasattr(self, '_showBoundary') and self._showBoundary:
            #diagnostic tool support
            canvas.setStrokeColor(gray)
            canvas.rect(0,0,self.width, self.height)
        canvas.restoreState()

    def wrapOn(self, canv, aW, aH):
        '''intended for use by packers allows setting the canvas on
        during the actual wrap'''
        self.canv = canv
        w, h = self.wrap(aW,aH)
        del self.canv
        return w, h

    def wrap(self, availWidth, availHeight):
        """This will be called by the enclosing frame before objects
        are asked their size, drawn or whatever.  It returns the
        size actually used."""
        return (self.width, self.height)

    def minWidth(self):
        """This should return the minimum required width"""
        return getattr(self,'_minWidth',self.width)

    def splitOn(self, canv, aW, aH):
        '''intended for use by packers allows setting the canvas on
        during the actual split'''
        self.canv = canv
        S = self.split(aW,aH)
        del self.canv
        return S

    def split(self, availWidth, availheight):
        """This will be called by more sophisticated frames when
        wrap fails. Stupid flowables should return []. Clever flowables
        should split themselves and return a list of flowables.
        If they decide that nothing useful can be fitted in the
        available space (e.g. if you have a table and not enough
        space for the first row), also return []"""
        return []

    def getKeepWithNext(self):
        """returns boolean determining whether the next flowable should stay with this one"""
        if hasattr(self,'keepWithNext'): return self.keepWithNext
        elif hasattr(self,'style') and hasattr(self.style,'keepWithNext'): return self.style.keepWithNext
        else: return 0

    def getSpaceAfter(self):
        """returns how much space should follow this item if another item follows on the same page."""
        if hasattr(self,'spaceAfter'): return self.spaceAfter
        elif hasattr(self,'style') and hasattr(self.style,'spaceAfter'): return self.style.spaceAfter
        else: return 0

    def getSpaceBefore(self):
        """returns how much space should precede this item if another item precedess on the same page."""
        if hasattr(self,'spaceBefore'): return self.spaceBefore
        elif hasattr(self,'style') and hasattr(self.style,'spaceBefore'): return self.style.spaceBefore
        else: return 0

    def isIndexing(self):
        """Hook for IndexingFlowables - things which have cross references"""
        return 0

    def identity(self, maxLen=None):
        '''
        This method should attempt to return a string that can be used to identify
        a particular flowable uniquely. The result can then be used for debugging
        and or error printouts
        '''
        if hasattr(self, 'getPlainText'):
            r = self.getPlainText(identify=1)
        elif hasattr(self, 'text'):
            r = str(self.text)
        else:
            r = '...'
        if r and maxLen:
            r = r[:maxLen]
        return "<%s at %s%s>%s" % (self.__class__.__name__, hex(id(self)), self._frameName(), r)

    def _doctemplateAttr(self,a):
        return getattr(getattr(getattr(self,'canv',None),'_doctemplate',None),a,None)

    def _frameName(self):
        f = getattr(self,'_frame',None)
        if not f: f = self._doctemplateAttr('frame')
        if f and f.id: return ' frame=%s' % f.id
        return ''

class XBox(Flowable):
    """Example flowable - a box with an x through it and a caption.
    This has a known size, so does not need to respond to wrap()."""
    def __init__(self, width, height, text = 'A Box'):
        Flowable.__init__(self)
        self.width = width
        self.height = height
        self.text = text

    def __repr__(self):
        return "XBox(w=%s, h=%s, t=%s)" % (self.width, self.height, self.text)

    def draw(self):
        self.canv.rect(0, 0, self.width, self.height)
        self.canv.line(0, 0, self.width, self.height)
        self.canv.line(0, self.height, self.width, 0)

        #centre the text
        self.canv.setFont(_baseFontName,12)
        self.canv.drawCentredString(0.5*self.width, 0.5*self.height, self.text)

def _trimEmptyLines(lines):
    #don't want the first or last to be empty
    while len(lines) and lines[0].strip() == '':
        lines = lines[1:]
    while len(lines) and lines[-1].strip() == '':
        lines = lines[:-1]
    return lines

def _dedenter(text,dedent=0):
    '''
    tidy up text - carefully, it is probably code.  If people want to
    indent code within a source script, you can supply an arg to dedent
    and it will chop off that many character, otherwise it leaves
    left edge intact.
    '''
    lines = text.split('\n')
    if dedent>0:
        templines = _trimEmptyLines(lines)
        lines = []
        for line in templines:
            line = line[dedent:].rstrip()
            lines.append(line)
    else:
        lines = _trimEmptyLines(lines)

    return lines


SPLIT_CHARS = "[{( ,.;:/\\-"

def splitLines(lines, maximum_length, split_characters, new_line_characters):
    if split_characters is None:
        split_characters = SPLIT_CHARS
    if new_line_characters is None:
        new_line_characters = ""
    # Return a table of lines
    lines_splitted = []
    for line in lines:
        if len(line) > maximum_length:
            splitLine(line, lines_splitted, maximum_length, \
            split_characters, new_line_characters)
        else:
            lines_splitted.append(line)
    return lines_splitted

def splitLine(line_to_split, lines_splitted, maximum_length, \
split_characters, new_line_characters):
    # Used to implement the characters added 
    #at the beginning of each new line created
    first_line = True

    # Check if the text can be splitted
    while line_to_split and len(line_to_split)>0:

        # Index of the character where we can split
        split_index = 0

        # Check if the line length still exceeds the maximum length
        if len(line_to_split) <= maximum_length:
            # Return the remaining of the line                
            split_index = len(line_to_split)
        else:
            # Iterate for each character of the line
            for line_index in range(maximum_length):
                # Check if the character is in the list
                # of allowed characters to split on
                if line_to_split[line_index] in split_characters:
                    split_index = line_index + 1
        
        # If the end of the line was reached
        # with no character to split on
        if split_index==0:
            split_index = line_index + 1

        if first_line:
            lines_splitted.append(line_to_split[0:split_index])
            first_line = False
            maximum_length -= len(new_line_characters)
        else:
            lines_splitted.append(new_line_characters + \
            line_to_split[0:split_index])
        
        # Remaining text to split
        line_to_split = line_to_split[split_index:]

class Preformatted(Flowable):
    """This is like the HTML <PRE> tag.
    It attempts to display text exactly as you typed it in a fixed width "typewriter" font.
    By default the line breaks are exactly where you put them, and it will not be wrapped.
    You can optionally define a maximum line length and the code will be wrapped; and 
    extra characters to be inserted at the beginning of each wrapped line (e.g. '> ').
    """
    def __init__(self, text, style, bulletText = None, dedent=0, maxLineLength=None, splitChars=None, newLineChars=""):
        """text is the text to display. If dedent is set then common leading space
        will be chopped off the front (for example if the entire text is indented
        6 spaces or more then each line will have 6 spaces removed from the front).
        """
        self.style = style
        self.bulletText = bulletText
        self.lines = _dedenter(text,dedent)
        if text and maxLineLength:
            self.lines = splitLines(
                                self.lines, 
                                maxLineLength, 
                                splitChars, 
                                newLineChars
                        )

    def __repr__(self):
        bT = self.bulletText
        H = "Preformatted("
        if bT is not None:
            H = "Preformatted(bulletText=%s," % repr(bT)
        return "%s'''\\ \n%s''')" % (H, '\n'.join(self.lines))

    def wrap(self, availWidth, availHeight):
        self.width = availWidth
        self.height = self.style.leading*len(self.lines)
        return (self.width, self.height)

    def minWidth(self):
        style = self.style
        fontSize = style.fontSize
        fontName = style.fontName
        return max([stringWidth(line,fontName,fontSize) for line in self.lines])

    def split(self, availWidth, availHeight):
        #returns two Preformatted objects

        #not sure why they can be called with a negative height
        if availHeight < self.style.leading:
            return []

        linesThatFit = int(availHeight * 1.0 / self.style.leading)

        text1 = '\n'.join(self.lines[0:linesThatFit])
        text2 = '\n'.join(self.lines[linesThatFit:])
        style = self.style
        if style.firstLineIndent != 0:
            style = deepcopy(style)
            style.firstLineIndent = 0
        return [Preformatted(text1, self.style), Preformatted(text2, style)]

    def draw(self):
        #call another method for historical reasons.  Besides, I
        #suspect I will be playing with alternate drawing routines
        #so not doing it here makes it easier to switch.

        cur_x = self.style.leftIndent
        cur_y = self.height - self.style.fontSize
        self.canv.addLiteral('%PreformattedPara')
        if self.style.textColor:
            self.canv.setFillColor(self.style.textColor)
        tx = self.canv.beginText(cur_x, cur_y)
        #set up the font etc.
        tx.setFont( self.style.fontName,
                    self.style.fontSize,
                    self.style.leading)

        for text in self.lines:
            tx.textLine(text)
        self.canv.drawText(tx)

class Image(Flowable):
    """an image (digital picture).  Formats supported by PIL/Java 1.4 (the Python/Java Imaging Library
       are supported. Images as flowables may be aligned horizontally in the
       frame with the hAlign parameter - accepted values are 'CENTER',
       'LEFT' or 'RIGHT' with 'CENTER' being the default.
       We allow for two kinds of lazyness to allow for many images in a document
       which could lead to file handle starvation.
       lazy=1 don't open image until required.
       lazy=2 open image when required then shut it.
    """
    _fixedWidth = 1
    _fixedHeight = 1
    def __init__(self, filename, width=None, height=None, kind='direct',
                 mask="auto", lazy=1, hAlign='CENTER'):
        """If size to draw at not specified, get it from the image."""
        self.hAlign = hAlign
        self._mask = mask
        fp = hasattr(filename,'read')
        if fp:
            self._file = filename
            self.filename = repr(filename)
        else:
            self._file = self.filename = filename
        if not fp and os.path.splitext(filename)[1] in ['.jpg', '.JPG', '.jpeg', '.JPEG']:
            # if it is a JPEG, will be inlined within the file -
            # but we still need to know its size now
            from reportlab.lib.utils import open_for_read
            f = open_for_read(filename, 'b')
            try:
                try:
                    info = pdfutils.readJPEGInfo(f)
                except:
                    #couldn't read as a JPEG, try like normal
                    self._setup(width,height,kind,lazy)
                    return
            finally:
                f.close()
            self.imageWidth = info[0]
            self.imageHeight = info[1]
            self._img = None
            self._setup(width,height,kind,0)
        elif fp:
            self._setup(width,height,kind,0)
        else:
            self._setup(width,height,kind,lazy)

    def _setup(self,width,height,kind,lazy):
        self._lazy = lazy
        self._width = width
        self._height = height
        self._kind = kind
        if lazy<=0: self._setup_inner()

    def _setup_inner(self):
        width = self._width
        height = self._height
        kind = self._kind
        img = self._img
        if img: self.imageWidth, self.imageHeight = img.getSize()
        if self._lazy>=2: del self._img
        if kind in ['direct','absolute']:
            self.drawWidth = width or self.imageWidth
            self.drawHeight = height or self.imageHeight
        elif kind in ['percentage','%']:
            self.drawWidth = self.imageWidth*width*0.01
            self.drawHeight = self.imageHeight*height*0.01
        elif kind in ['bound','proportional']:
            factor = min(float(width)/self.imageWidth,float(height)/self.imageHeight)
            self.drawWidth = self.imageWidth*factor
            self.drawHeight = self.imageHeight*factor

    def _restrictSize(self,aW,aH):
        if self.drawWidth>aW+_FUZZ or self.drawHeight>aH+_FUZZ:
            self._oldDrawSize = self.drawWidth, self.drawHeight
            factor = min(float(aW)/self.drawWidth,float(aH)/self.drawHeight)
            self.drawWidth *= factor
            self.drawHeight *= factor
        return self.drawWidth, self.drawHeight

    def _unRestrictSize(self):
        dwh = getattr(self,'_oldDrawSize',None)
        if dwh:
            self.drawWidth, self.drawHeight = dwh

    def __getattr__(self,a):
        if a=='_img':
            from reportlab.lib.utils import ImageReader  #this may raise an error
            self._img = ImageReader(self._file)
            if not isinstance(self._file,strTypes):
                self._file = None
                if self._lazy>=2: self._lazy = 1    #here we're assuming we cannot read again
            return self._img
        elif a in ('drawWidth','drawHeight','imageWidth','imageHeight'):
            self._setup_inner()
            return self.__dict__[a]
        raise AttributeError("<Image @ 0x%x>.%s" % (id(self),a))

    def wrap(self, availWidth, availHeight):
        #the caller may decide it does not fit.
        return self.drawWidth, self.drawHeight

    def draw(self):
        lazy = self._lazy
        if lazy>=2: self._lazy = 1
        self.canv.drawImage(    self._img or self.filename,
                                getattr(self,'_offs_x',0),
                                getattr(self,'_offs_y',0),
                                self.drawWidth,
                                self.drawHeight,
                                mask=self._mask,
                                )
        if lazy>=2:
            self._img = self._file = None
            self._lazy = lazy

    def identity(self,maxLen=None):
        r = Flowable.identity(self,maxLen)
        if r[-4:]=='>...' and isinstance(self.filename,str):
            r = "%s filename=%s>" % (r[:-4],self.filename)
        return r

class NullDraw(Flowable):
    def draw(self):
        pass

class Spacer(NullDraw):
    """A spacer just takes up space and doesn't draw anything - it guarantees
       a gap between objects."""
    _fixedWidth = 1
    _fixedHeight = 1
    def __init__(self, width, height, isGlue=False):
        self.width = width
        if isGlue:
            self.height = 1e-4
            self.spacebefore = height
        self.height = height

    def __repr__(self):
        return "%s(%s, %s)" % (self.__class__.__name__,self.width, self.height)

class UseUpSpace(NullDraw):
    def __init__(self):
        pass

    def __repr__(self):
        return "%s()" % self.__class__.__name__

    def wrap(self, availWidth, availHeight):
        self.width = availWidth
        self.height = availHeight
        return (availWidth,availHeight-1e-8)  #step back a point

class PageBreak(UseUpSpace):
    """Move on to the next page in the document.
       This works by consuming all remaining space in the frame!"""
    def __init__(self,nextTemplate=None):
        self.nextTemplate = nextTemplate

class SlowPageBreak(PageBreak):
    pass

class PageBreakIfNotEmpty(PageBreak):
    pass

class CondPageBreak(Spacer):
    """use up a frame if not enough vertical space effectively CondFrameBreak"""
    def __init__(self, height):
        self.height = height

    def __repr__(self):
        return "CondPageBreak(%s)" %(self.height,)

    def wrap(self, availWidth, availHeight):
        if availHeight<self.height:
            f = self._doctemplateAttr('frame')
            if not f: return availWidth, availHeight
            from reportlab.platypus.doctemplate import FrameBreak
            f.add_generated_content(FrameBreak)
        return 0, 0

    def identity(self,maxLen=None):
        return repr(self).replace(')',',frame=%s)'%self._frameName())

def _listWrapOn(F,availWidth,canv,mergeSpace=1,obj=None,dims=None,fakeWidth=None):
    '''return max width, required height for a list of flowables F'''
    doct = getattr(canv,'_doctemplate',None)
    cframe = getattr(doct,'frame',None)
    if fakeWidth is None:
        fakeWidth = listWrapOnFakeWidth
    if cframe:
        from reportlab.platypus.doctemplate import _addGeneratedContent, Indenter
        doct_frame = cframe
        cframe = doct.frame = deepcopy(doct_frame)
        cframe._generated_content = None
        del cframe._generated_content
    try:
        W = 0
        H = 0
        pS = 0
        atTop = 1
        F = F[:]
        while F:
            f = F.pop(0)
            if hasattr(f,'frameAction'):
                from reportlab.platypus.doctemplate import Indenter
                if isinstance(f,Indenter):
                    availWidth -= f.left+f.right
                continue
            w,h = f.wrapOn(canv,availWidth,0xfffffff)
            if dims is not None: dims.append((w,h))
            if cframe:
                _addGeneratedContent(F,cframe)
            if w<=_FUZZ or h<=_FUZZ: continue
            W = max(W,min(w,availWidth) if fakeWidth else w)
            H += h
            if not atTop:
                h = f.getSpaceBefore()
                if mergeSpace:
                    if getattr(f,'_SPACETRANSFER',False):
                        h = pS
                    h = max(h-pS,0)
                H += h
            else:
                if obj is not None: obj._spaceBefore = f.getSpaceBefore()
                atTop = 0
            s = f.getSpaceAfter()
            if getattr(f,'_SPACETRANSFER',False):
                s = pS
            pS = s
            H += pS
        if obj is not None: obj._spaceAfter = pS
        return W, H-pS
    finally:
        if cframe:
            doct.frame = doct_frame

def _flowableSublist(V):
    "if it isn't a list or tuple, wrap it in a list"
    if not isinstance(V,(list,tuple)): V = V is not None and [V] or []
    from reportlab.platypus.doctemplate import LCActionFlowable
    assert not [x for x in V if isinstance(x,LCActionFlowable)],'LCActionFlowables not allowed in sublists'
    return V

class _ContainerSpace:  #Abstract some common container like behaviour
    def getSpaceBefore(self):
        for c in self._content:
            if not hasattr(c,'frameAction'):
                return c.getSpaceBefore()
        return 0

    def getSpaceAfter(self,content=None):
        #this needs 2.4
        #for c in reversed(content or self._content):
        reverseContent = (content or self._content)[:]
        reverseContent.reverse()
        for c in reverseContent:
            if not ha