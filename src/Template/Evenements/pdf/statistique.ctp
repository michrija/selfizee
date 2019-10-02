<?php 
	echo $contenu;
?>
<style>
	@import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600');
	body{
		font-family: 'Montserrat', sans-serif;
	}
	/* généralités */
	.text-center{
		text-align: center;
	}
	.text-right{
		text-align: right;
	}
	.bloc-0-1{
		height: 50%;
		position: relative;
	}
	.bloc-0-1 .titre{
		position: absolute;
		bottom: 52%;
	}
	.bloc-0-1:after{
		content: ' ';
		display: block;
		border-bottom: solid 1px #000000;
		left:	45%;
		width: 10%;
		position: absolute;
		bottom: 51%;
	}
	.bloc-0-2{
		padding-top: 15px 0 0 0;
	}
	.gris{
		color: #999;
	}
	h1{
		font-size: 70px;
		font-weight: 600;
	}
	.bottom, .bottom-0{
		position: absolute;
		width: 100%;
	}
	.bottom{
		bottom: 75px;
	}
	.bottom-0{
		bottom: -10px;
	}
	.paragraphe{
		font-weight: 500;
		font-size: 38px;
	}
	.padding{
		padding: 120px 20px;
	}
	.full{
		width: 100%;
	}
	/* en tete */
	.entete{
		font-size: 36px;
		font-weight: 600;
	}
	.sous-entete{
		font-size: 60px;
	}
	/* email */
	.sf-email-bloc-2{
		width: 500px;
		display: inline-block;
		padding-left: 90px;
		padding-right: 90px;
	}
	.sf-email-bloc-0, .sf-email-bloc-1{
		width: 320px;
		height: 280px;
		display: inline-block;
		border: solid 1px #ECECEC;
		margin-right: 60px;
	}
	.sf-email-bloc-1{
		width: 472px;
		background-color: #595959;
	}
	.sf-email-bloc-total{
		background-color: #F0F0F0;
	}
	.sf-bloc-0-enfant{
		width: 100%;
		color: white;
		font-size: 23px;
		margin-left: 40px;
		margin-bottom: 3px;
	}
	.enfant-1{
		display: inline-block;
	}
	/* sms */
	.sf-sms-bloc{
		margin-left: 240px;
		margin-top: 250px;
	}
	/* global */
	.sf-global{
		width: 32%;
		display: inline-block;
	}
	.sf-global-mil:before{
		content: '';
		display: inline-block;
		border-left: solid 2px #ECECEC;
		height: 350px;
		position:absolute;
		top: 80px;
	}
	.sf-global-mil:after{
		content: '';
		display: inline-block;
		border-right: solid 2px #ECECEC;
		height: 350px;
		position:absolute;
		top: 80px;
		margin-left: 100%;
	}
	/* demographie */
	.sf-demo-bloc{
		margin-left: 20px;
		margin-top: 110px;
		width: 96%;
		height: 60px;
		border: solid 1px #ECECEC;
	}
	.sf-inline-block{
		display: inline-block;
	}
	.sf-demo-bloc-0{
		width: 400px;
		height: 280px;
		margin-top: -10px;
	}
	.sf-demo-bloc-1{
		width: 600px;
		height: 280px;
		margin-top: -10px;
	}
	.liste li:after{
		content: '';
		display: inline-block;
		width: 16px;
		height: 16px;
		/* background-color: #E72763; */
		position: absolute;
		left: 400px;
		margin-top: 44px;
		-webkit-border-radius: 8px;
		-moz-border-radius: 8px;
		border-radius: 8px;
	}
	.liste .li-1:after{
		background-color: #d0f442;
	}
	.liste .li-2:after{
		background-color: #f47842;
	}
	.liste .li-3:after{
		background-color: #f4ea42;
	}
	.liste .li-4:after{
		background-color: #42abf4;
	}
	.liste .li-5:after{
		background-color: #c442f4;
	}
	.liste li:last-child:after{
		margin-top: 56px;
	}
	.liste li{
		margin-bottom: 12px;
	}
	.liste{
		list-style-type: none;
		font-size: 24px;
	}
	.liste1 li img{
		width: 40px;
		margin-top: 13px;
		margin-right: 20px;
	}
	.liste1 li{
		margin-left: 80px;
	}
	.liste1{
		list-style-type: none;
		font-size: 24px;
	}
	/* progress */
	.progress{
		margin-top: -38px;
		display: block;
		width: 278px;
		margin-left: 20px;
		background-color: #ECECEC;
	}
	.progress1{
		margin-top: -38px;
		display: block;
		width: 540px;
		margin-left: 20px;
		background-color: #ECECEC;
	}
	.sf-bloc-sexe{
		width: 45px;
		margin-top: 32px;
		font-size: 50px;
		margin-left: 40px;
	}
	.sf-bloc-sexe-prog{
		margin-top: 60px;
		padding-right: 35px;
	}
	/* bloc pour cent bloc1 */
	.sf-email-bloc-pc-1, .sf-email-bloc-pc-2{
		font-size: 70px;
		font-weight: bold;
		color: #E72763;
		display: inline-block;
		width: 50%;
		text-align: left;
		margin-top: 10px;
	}
	.sf-nb-detail{
		font-size: 80px;
		font-weight: normal;
		color: #E72763;
		margin-top: 30px;
	}
	.sf-email-bloc-pc-2{
		font-size: 40px;
		color: #6D6D6D;
		text-align: right;
	}
	.txt-gris{
		color: #555;
	}
</style>
