<?php
session_start();
?>

<script type="text/javascript">
	jQuery(function() {
		jQuery("#accordion").accordion({
			heightstyle : "content",
			collapsible : true,
			active : false
		});
	});

	$('#navigation').slimmenu({
		resizeWidth : '800',
		collapserTitle : 'Main Menu',
		animSpeed : 'medium',
		easingEffect : null,
		indentChildren : false,
		childrenIndenter : '&nbsp;'
	}); 
</script>

<ul id="nav" class="slimmenu">
	

                
                <li id="start">
                    <a href="#">Willkommen</a>
                    <ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                        <li>
                            <a href="#">Slim Menu 1.1</a></li>
                            
                              <li><a href="#">Slim Menu 1.2</a></li>
                    </ul>
                </li>
                
                <li id="gruppenphase">
                	<a href="#">Meine Tipps</a>
                	<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                        <li>
                            <a href="#">Slim Menu 1.1</a></li>
                            
                              <li><a href="#">Slim Menu 1.2</a></li>
                    </ul>               	
                </li>
                                         
                <li>              	
                      <a href="#">Statistiken</a>
                 <ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                        <li>
                            <a href="#">Slim Menu 3.1</a></li>
                            
                       
                        <li><a href="#">Slim Menu 3.2</a></li>
                    </ul>
               
                <li>
                	<a href="#">Alles rund um die WM</a>
                	<ul style="display: none; height: 90px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                        <li>
                            <a href="#">Slim Menu 3.1</a></li>
                            
                       
                        <li><a href="#">Slim Menu 3.2</a></li>
                    </ul>
                	
                	
                	</li>

	
	</ul>


















