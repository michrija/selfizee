<?php 
declare(strict_types=1);

if (php_sapi_name() != "cli") {
	// chdir("../");
}

include('pChart/pDraw.php');
include('pChart/pData.php');
include('pChart/pColor.php');
include('pChart/pPie.php');


use pChart\pColor;
use pChart\pDraw;
use pChart\pPie;


$myPicture = new pDraw(350,145,TRUE);

/* Populate the pData object */
$myPicture->myData->addPoints($points);

/* Define the abscissa serie */
$myPicture->myData->addPoints(["- 20 ans", "20 - 30 ans", "30 - 40 ans", "40 - 60 ans", "+ 60 ans"],"Labels");
$myPicture->myData->setAbscissa("Labels");

/* Set the default font properties */ 
$myPicture->setFontProperties(["FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>10,"Color"=>new pColor(80)]);

/* Create the pPie object */ 
$PieChart = new pPie($myPicture);

/* Enable shadow computing */ 
$myPicture->setShadow(TRUE,["X"=>3,"Y"=>3,"Color"=>new pColor(0,0,0,50)]);

/* Draw a split pie chart */ 
$PieChart->draw3DPie(120,90,["Radius"=>100,"DataGapAngle"=>0,"DataGapRadius"=>10,"Border"=>TRUE]);

/* Write the legend box */ 
$myPicture->setFontProperties(["FontName"=>"pChart/fonts/Silkscreen.ttf","FontSize"=>6,"Color"=>new pColor(0,0,0,50)]);
$PieChart->drawPieLegend(-180,0,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL]);

/* Render the picture (choose the best way) */
$myPicture->render("transparent.png");





?>