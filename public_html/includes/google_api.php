<?php

//http://dev.viaspace-redesign.com/
$google_key = "ABQIAAAAXM-CKy52v1_gPzFHQd4sChSBBTMGg9pvYyYDp_kfPg27OZxnGhR6UxGqnhQ14fulC5N4_dByuN2q6Q";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Site Restricted Search - Google AJAX Search API Sample</title>
    <link href="../../css/gsearch.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/gsearch_green.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">

    body {
      background-color: white;
      color: black;
      font-family: Arial, sans-serif;
      font-size: small;
      margin: 15px;
    }

    /*
     * Highlight -siteSearch in results area
     */

    /* bold the section header */
    .gsc-resultsRoot-siteSearch .gsc-title {
      font-weight : bold;
    }

    .gsc-resultsRoot-siteSearch .gsc-keeper {
      background-image : url('../../css/orange_check.gif');
      font-weight : bold;
    }


    </style>
    <script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0&key=<?php echo $google_key; ?>" type="text/javascript"></script>

    <script type="text/javascript">
    //<![CDATA[

    function OnLoad() {
      // Create a search control
      var searchControl = new GSearchControl();

      // site restricted web search with custom label
      // and class suffix
      var siteSearch = new GwebSearch();
      siteSearch.setUserDefinedLabel("viaspace.com");
      siteSearch.setUserDefinedClassSuffix("siteSearch");
      siteSearch.setSiteRestriction("viaspace.com");
      searchControl.addSearcher(siteSearch);

      // site restricted web search using a custom search engine
      /*
	  siteSearch = new GwebSearch();
      siteSearch.setUserDefinedLabel("Product Reviews");
      siteSearch.setSiteRestriction("000455696194071821846:reviews");
      searchControl.addSearcher(siteSearch);

      // standard, unrestricted web search
      searchControl.addSearcher(new GwebSearch());

      // site restricted blog search
      var blogSearch = new GblogSearch();
      blogSearch.setUserDefinedLabel("LJ Nintendo DS Blog");
      blogSearch.setSiteRestriction("http://community.livejournal.com/nintendo_ds/");
      searchControl.addSearcher(blogSearch);

      // site restricted news search
      var newsSearch = new GnewsSearch();
      newsSearch.setUserDefinedLabel("Seattle Times");
      newsSearch.setSiteRestriction("Seattle Times");
      searchControl.addSearcher(newsSearch);

      // Establish a keep callback
      searchControl.setOnKeepCallback(null, DummyClipSearchResult);
*/
      // tell the searcher to draw itself and tell it where to attach
      searchControl.draw(document.getElementById("searchcontrol"));
	
	
      // execute an inital search
      searchControl.execute("viaspace");
    }

    function DummyClipSearchResult(result) {}

    GSearch.setOnLoadCallback(OnLoad);
    //]]>
    </script>
  </head>
  <body>
    <div id="searchcontrol"/>
  </body>
</html>
