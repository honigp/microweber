


<div id="footer">

    <div class="container">

        <div class="row" id="footer-row">
            <div class="span5">Copyright &copy; Microweber. All Rights Reserved</div>
            <div class="span7" id="PowerdByHolder">
            <a href="https://github.com/ooyes/Microweber" target="_blank">We are on Github</a> 
                <div id="PowerdBy">
                    <a title="Powered by Microweber" id="PowerdByLink" target="_blank" href="http://microweber.com">(MW)</a>
                    <div id="PowerdByInfo">Powered By <a href="http://microweber.com" target="_blank">Microweber</a></div>
                </div>
            </div>
        </div>

    </div>
</div>




<div id="mwmodal" class="modal hide fade">



<div class="modal-header" id="mwmodal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h3 id="mwmodal-header-title">&nbsp;</h3>
</div>
<div class="modal-body" id="mwmodal-content">
</div>
    <div class="modal-footer">
                <a href="javascript:;" class="btn pull-left" style="margin-top: 7px;" data-dismiss="modal" aria-hidden="true">Cancel</a>
                <a href="/download.php" class="btn btn-large btn-info pull-right" rel="nofollow" onclick="$('mwmodal').modal('hide')">Download</a>  </div>


    </div>

<? if(isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] != '78.90.67.20'):  ?>

<script src="https://www.statsmix.com/api/v2/track?api_key=10833ccca2cb5dd7ca31&value=1&name=visit"></script>
<?php 
if(!isset($_COOKIE['_unique_visit'])){
	$value = 'mw_unique_visit';
	setcookie("_unique_visit", $value, time()+3600);  /* expire in 1 hour */
	print '<script src="https://www.statsmix.com/api/v2/track?api_key=10833ccca2cb5dd7ca31&value=1&name=unique_visit"></script>'; 

}


?>

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1065179-55', 'microweber.net');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
  var GoSquared = {acct: "GSN-395984-X"};
  (function(w){
    function gs(){
      w._gstc_lt = +new Date;
      var d = document, g = d.createElement("script");
      g.type = "text/javascript";
      g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
      var s = d.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(g, s);
    }
    w.addEventListener ? w.addEventListener("load", gs, false) : w.attachEvent("onload", gs);
  })(window);
</script>


<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-1065179-29']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>

<!-- TYXO -->
  <script type="text/javascript">
  <!--
  d=document;d.write('<a href="http://www.tyxo.bg/?146467" title="Tyxo.bg counter"><img width="1" height="1" border="0" alt="Tyxo.bg counter" src="'+location.protocol+'//cnt.tyxo.bg/146467?rnd='+Math.round(Math.random()*2147483647));
  d.write('&sp='+screen.width+'x'+screen.height+'&r='+escape(d.referrer)+'"></a>');
  //-->
  </script><noscript><a href="http://www.tyxo.bg/?146467" title="Tyxo.bg counter"><img src="http://cnt.tyxo.bg/146467" width="1" height="1" border="0" alt="Tyxo.bg counter" /></a></noscript>
<!-- / TYXO -->
<? endif; ?>
</body>
</html>