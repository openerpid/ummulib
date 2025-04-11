<?php

namespace Ummulib;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* Website: https://ummulib.openerp.id/
* App: UMMULIB
* Description: 
* =============================================
*/

class UmmuInstall
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function run()
    {
        $this->is_symlink();
        $this->create_symlink();
    }

    public function is_symlink()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // if (is_link(FCPATH."uploads")) {
            //     exec("rmdir /s  ".FCPATH."uploads");
            // }

            // if (is_link(FCPATH."vendor/dorbitt-lib")) {
            //     exec("rmdir /s  ".FCPATH."vendor/dorbitt-lib");
            // }

            // if (is_link(FCPATH."Gasset")) {
            //     exec("rmdir /s  ".FCPATH."Gasset");
            // }

            // if (is_link(APPPATH."Gviews")) {
            //     exec("rmdir /s  ".APPPATH."Gviews");
            // }

            // if (!is_dir(FCPATH."vendor")) {
            //     exec("mkdir ". FCPATH ."vendor");
            // }

            // if (is_link(APPPATH."Controllers/MyGallery")) {
            //     exec("rmdir /s  ".APPPATH."Controllers/MyGallery");
            // }

            $upload = FCPATH."uploads";
            if (is_link($upload) OR is_dir($upload)) {
                unlink($upload);
            }elseif (is_file($upload)) {
                rmdir($upload);
            }

            $lib = FCPATH."vendor/ummulib";
            if (is_link($lib) or is_dir($lib)) {
                rmdir($lib);
            }elseif(is_file($lib)){
                unlink($lib);
            }

            $gAsset = FCPATH."Gasset";
            if (is_link($gAsset)) {
                rmdir($gAsset);
            }elseif(is_file($gAsset)){
                unlink($gAsset);
            }

            $gViews = APPPATH."Gviews";
            if (is_link($gViews)) {
                rmdir($gViews);
            }elseif(is_file($gViews)){
                unlink($gViews);
            }

            $vendor = FCPATH."vendor";
            if (!is_dir($vendor)) {
                rmdir($vendor);
            }elseif(is_file($vendor)){
                unlink($vendor);
            }

            $myGallery = APPPATH."Controllers/MyGallery";
            if (is_link($myGallery)) {
                rmdir($myGallery);
            }elseif(is_file($myGallery)){
                unlink($myGallery);
            }
        }else{
            if (is_link(FCPATH."uploads")) {
                exec("rm -rf ".FCPATH."uploads");
            }

            if (is_link(FCPATH."vendor/ummulib")) {
                exec("rm -rf ".FCPATH."vendor/ummulib");
            }

            if (is_link(FCPATH."Gasset")) {
                exec("rm -rf ".FCPATH."Gasset");
            }

            if (is_link(APPPATH."Gviews")) {
                exec("rm -rf ".APPPATH."Gviews");
            }

            if (!is_dir(FCPATH."vendor")) {
                exec("mkdir ". FCPATH ."vendor");
            }

            if (is_link(APPPATH."Controllers/MyGallery")) {
                exec("rm -rf ".APPPATH."Controllers/MyGallery");
            }
        }
    }

    public function create_symlink()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            symlink(WRITEPATH."uploads", FCPATH."uploads");
            symlink(ROOTPATH."vendor/ummu/lib/src/Gasset", FCPATH."vendor/ummulib");
            symlink(ROOTPATH."vendor/ummu/lib/src/Gasset", FCPATH."Gasset");
            symlink(ROOTPATH."vendor/ummu/lib/src/Gviews", APPPATH."Gviews");
            symlink(ROOTPATH."vendor/ummu/lib/src/Controllers/MyGallery", APPPATH."Controllers/MyGallery");
        } else {
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("ln -s ".ROOTPATH."vendor/ummu/lib/src/Gasset"." ".FCPATH."vendor/ummulib");
            exec("ln -s ".ROOTPATH."vendor/ummu/lib/src/Gasset"." ".FCPATH."Gasset");
            exec("ln -s ".ROOTPATH."vendor/ummu/lib/src/Gviews"." ".APPPATH."Gviews");
            exec("ln -s ".ROOTPATH."vendor/ummu/lib/src/Controllers/MyGallery"." ".APPPATH."Controllers/MyGallery");
        }
    }
}