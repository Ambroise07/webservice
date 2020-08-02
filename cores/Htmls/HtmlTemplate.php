<?php

namespace App\Htmls;

class HtmlTemplate
{
    private static $text;
    private static $message;
    private static $domaine_name = 'https://url.informatutos.com/';
        /**
     * return html template link element .
     *
     * @param string $linkname
     * @param string $linkdestination
     * @param string $linkdescription
     * @param string $linkads
     * @param string $linkauthor
     * @param string $linkcreateddate
     * @param string $linkmodifydate
     * @param string $linkstatus
     * @param string $linkview
     *
     *  * @return string
     */
    public static function htmlLink($router,$linkname, $link_struc, $linkdestination, $linkdescription, $linkads): string
    {
        return '<div class="col-lg-8 mb-3">
            <div class="card shadow">
                <div class="card-header">Link Name : '.$linkname.' <span class="clip-copy fa fa-clipboard float-right" title="Cliquer pour Copier"  data-placement="top" data-clipboard-text='.self::$domaine_name.$link_struc.'></span> </div>
                <div class="card-body">
                    <h5 class="card-title">Lien de destination : <span class="ml-4">'.$linkdestination.'</span></h5>
                    <div class="card-text">
                        <p class="font-p">'.$linkdescription.'</p>
                    </div>
                    <a href="'.$linkads.'" target="_blank" class="btn btn-url">Ouvrire le lien</a>
                    <a href="'.($router->url('linkdetail',['structure'=>$link_struc])).'" class="float-right btn btn-url">Details du lien</a>
                </div>
            </div>
            <hr class="separator" style="width: 50%;">
    </div>';
    }

}
