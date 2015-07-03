
<?php
$this->pageTitle = "Цены и наши проекты";
?>	
		
                
             <section class="section" id="project">
                    
                    <p class="section_menu"><a href="/index" class="botton_form f_left">На главную</a></p>
					<div class="container">                       
                        
						<div class="container_inner" style="border-top:1px solid black;">
                           
                            
							<div class="container_inner_header" class="f_left">
                                <h3 class="LazurskiC" style=""><?php echo $project->title?></h3>
                                <p class="container_inner_text f_left" style="">
                                    <?php echo nl2br($project->description);?>
                                </p>
                            </div>
                                
                                
                                               
                                       <div class="project_block f_right" style="">
                                            <?php  foreach ($project->attachment as $key => $value) {
                          
                                                if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->getBaseUrl().'/Image/AttachmentWork/'.$value->img)) {
                                                    echo '<a href="/Image/AttachmentWork/'.$value->img.'" data-lightbox="roadtrip">'.CHtml::image('/Image/AttachmentWork/mini-'.$value->img, $value->id,
                                                    array(
                                                        'class' => 'f_left',
                                                        'width' => '170px',
                                                        'style' => 'margin-bottom:10px;margin-left:10px;'
                                                        )
                                                    ).'</a>';
                                                }
                                            }
                                            ?>
                                            

                                        </div>
                                
    
                           
						</div>
					</div>
				</section>
   