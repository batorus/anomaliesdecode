<?php

namespace AnomaliesBundle\Twig;

class AnomaliesdecodeExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('isfile', array($this, 'isFile')),
//            new \Twig_SimpleFilter('switchAnneeMois', array($this, 'switchAnneeMois')),
//            new \Twig_SimpleFilter('moisAnneeMakeDate', array($this, 'moisAnneeMakeDate')),
        );
    }
    
    public function isFile($item){
        //    dump($item);die();
        if(is_file($item)){

          return true;
        }

        return false;
    }

//    public function frMoisFilter($item)
//    {
//		$item = str_replace(' 1, ', ' ' , $item);
//		$item = str_replace(
//			array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
//			array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"),
//			$item
//		);	
//        return $item;
//    }
//
//    public function switchAnneeMois($item)
//    {
//		$parts = explode('-', $item);
//		return $parts[1] . $parts[0];
//    }
//	
//    public function moisAnneeMakeDate($item)
//    {
//		$parts = explode('-', $item);
//		return '20' . $parts[1] . '-' . $parts[0] . '-01';
//    }

    public function getName()
    {
        return 'anomaliesdecode_extension';
    }
}