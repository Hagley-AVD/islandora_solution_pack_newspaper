<?php

/**
 * @file
 * This is the template file for the object page for newspaper.
 *
 * Available variables:
 * - $islandora_content: A rendered vertical tabbed newspapper issue browser.
 * - $parent_collections: An array containing parent collection
 *                        IslandoraFedoraObject(s).
 * - $description: Rendered metadata descripton for the object.
 * - $metadata: Rendered metadata display for the binary object.
 *
 * @see template_preprocess_islandora_newspaper()
 */

    $dc_object = DublinCore::importFromXMLString($object['DC']->content);
    $dc_array = $dc_object->asArray();


?>
<div id="get-host" style="display:none;">
<?php echo $_SERVER['HTTP_HOST']; ?>
</div>
<div id="get-pid" style="display:none;">
<?php echo $object->id ?>
</div>	
<script type="text/javascript">
var getpid = document.getElementById("get-pid");
var pid = getpid.textContent;
function newspaperSearch(){
	var query = document.getElementById("np-query").value;
	var newspaperQuery = "/islandora/search/" + query + "?type=dismax&f[0]=RELS_EXT_isMemberOf_uri_ms:\"info:fedora/" + pid +"\"";
	window.location.assign(newspaperQuery)
}

</script>
<div class="islandora-newspaper-object islandora">
 <div class="newspaper-landing-wrapper">
  <div class="newspaper-image-wrapper">
   <div><img src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/islandora/object/<?php echo $object->id ?>/datastream/MEDIUM/view"/></div>
  </div>
   <div class="newspaper-description-wrapper">
 	<h1 class="title">About this collection</h1><p><?php print $dc_array['dc:description']['value']; ?></p>
	<div class="newspaper-search-wrapper"><h3>Search within this collection:</h3><div class="newspaper-search-box">
	<form action="#" onSubmit="newspaperSearch(this);return false;"><input class="form-text" type="text" name="np-query" id="np-query" value="" />
	<input type="button" class="form-submit btn-default" value="Search" onSubmit="return newspaperSearch();" onClick="return newspaperSearch();"  /></form></div>
  </div>
 </div>  
</div>
  <div class="islandora-newspaper-content-wrapper clearfix">
    <?php if ($islandora_content): ?>
      <div class="islandora-newspaper-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="islandora-newspaper-metadata">
    <?php print $description; ?>
    <?php if ($parent_collections): ?>
      <div>
        <h2><?php print t('In collections'); ?></h2>
        <ul>
          <?php foreach ($parent_collections as $collection): ?>
        <li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <?php print $metadata; ?>
  </div>
</div>
