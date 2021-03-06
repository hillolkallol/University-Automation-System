$rpm
            return 0
            ;;
        --macros|--rcfile)
            _filedir
            return 0
            ;;
        --buildpolicy)
            local cfgdir=$( $rpm --eval '%{_rpmconfigdir}' 2>/dev/null )
            if [[ $cfgdir ]]; then
                COMPREPLY=( $( compgen -W "$( command ls $cfgdir 2>/dev/null \
                    | sed -ne 's/^brp-//p' )" -- "$cur" ) )
            fi
            ;;
        --define|-D|--with|--without)
            return 0
            ;;
    esac

    $split && return 0

    if [[ $cur == -* ]]; then
        COMPREPLY=( $( compgen -W "$( _parse_help "$1" )" -- "$cur" ) )
        [[ $COMPREPLY == *= ]] && compopt -o nospace
        return 0
    fi

    # Figure out file extensions to complete
    local word ext
    for word in ${words[@]}; do
        case $word in
            -b?)
                ext=spec
                break
                ;;
            -t?|--tarbuild)
                ext='@(t?(ar.)@([gx]z|bz?(2))|tar?(.@(lzma|Z)))'
                break
                ;;
            --rebuild|--recompile)
                ext='@(?(no)src.r|s)pm'
                break
                ;;
        esac
    done
    [[ -n $ext ]] && _filedir $ext
} &&
complete -F _rpmbuild rpmbuild rpmbuild-md5

# ex: ts=4 sw=4 et filetype=sh
                                                                                                                                                                                                                                                                                                                                                                                                