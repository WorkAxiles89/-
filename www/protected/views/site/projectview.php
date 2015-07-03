
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
                                    Общая стоимость составляет <?php echo  number_format($project->cast, 0, ',', ' ');?> руб.
                                </p>
                            </div>
                                
                                <div class="project_block f_left" style="width:48%">
                                    <div class="f_right" style="width: 100%;">
                                        <a href="/Image/Project/<?php echo $project->img?>" data-lightbox="roadtrip">
                                            <img class="f_left" src="<?php echo Yii::app()->request->baseUrl; ?>/Image/Project/mini-<?php echo $project->img?>"/>
                                        </a>
                            
                                    </div>
                                    <div class="project_blocktext f_left"  style="margin-top:10px;width:100%">
      
                                        <p class="project_textmini LazurskiC">
             
                                                <?php echo nl2br($project->description);?>

                                        </p>
                         
                                    </div>
                                </div> 
                                
                                               
                                       <div class="project_block f_right" style="width:50%">
                                            <?php  foreach ($project->attachment as $key => $value) {
                          
                                                if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->getBaseUrl().'/Image/AttachmentProject/'.$value->img)) {
                                                    echo '<a href="/Image/AttachmentProject/'.$value->img.'" data-lightbox="roadtrip">'.CHtml::image('/Image/AttachmentProject/mini-'.$value->img, $value->id,
                                                    array(
                                                        'class' => 'f_right',
                                                        'width' => '370px',
                                                        'style' => 'margin-bottom:10px;'
                                                        )
                                                    ).'</a>';
                                                }
                                            }
                                            ?>
                                            

                                        </div>
                                
    
                           
						</div>
					</div>
				</section>
   