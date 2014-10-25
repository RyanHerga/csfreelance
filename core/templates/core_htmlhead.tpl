<?php
/**
 * 	STOP! HAMMER TIME!
 * 
 * ====> READ THIS !!!!!
 * 
 * I really really, REALLY suggest you don't edit this file.
 * Why? This is the "main header" file where I put changes for updates. 
 * And you don't want to have to manually go through and figure those out.
 * 
 * That equals headache for you, and headache for me to figure out what went wrong.
 * 
 * BUT BUT WAIT, you say... I want to include more javascript, css, etc...! 
 * Well - in your skin's header.tpl file, this file is included as:
 * 
 * Template::Show('core_htmlhead.tpl');
 * 
 * Just add your stuff under that line there. That way, it's in the proper
 * spot, and this file stays intact for the system (and me) to be able to
 * make clean updates whenever needed. Less bugs = happy users (and happy me)
 * 
 * THANKS!s
 */
?>

	<script src="<?php echo SITE_URL; ?>lib/skins/crystal/js/jquery.js"></script>
	<script src="<?php echo SITE_URL; ?>lib/skins/crystal/js/bootstrap.min.js"></script>
	<script src="//cdn.import.io/js/2.0.0/importio.js"></script>
	<link href="<?php echo SITE_URL; ?>lib/skins/crystal/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo SITE_URL; ?>lib/skins/crystal/css/style.css" rel="stylesheet">
	<script src="<?php echo SITE_URL; ?>lib/skins/crystal/js/cufon-yui.js" type="text/javascript"></script>
	<script src="<?php echo SITE_URL; ?>lib/skins/crystal/js/allianz-sans.cufonfonts.js" type="text/javascript"></script>
	<script src="<?php echo SITE_URL; ?>core/lib/sweet-alert.js" type="text/javascript"></script>
	<link href="<?php echo SITE_URL; ?>core/lib/sweet-alert.css" rel="stylesheet">
	<script type="text/javascript">
	Cufon.replace('.allianz', { fontFamily: 'Allianz Sans Bold', hover: true }); 
	</script>
	<script type="text/javascript">
	importio.init({
	  "auth": {
	    "userGuid": "b820e60d-f83c-4a70-9db6-f22b5363b6d1",
	    "apiKey": "lzPyB20UalNSGQK07gfjipPfhjQQ53GsJeY0eBd0UCCdFyBqBvGzRD4Eldev5poLbcHEiozgvEgL6GoF8h7YgQ==",
	  },
	  "host": "import.io"
	  });
	</script>
<?php
echo $MODULE_HEAD_INC;
