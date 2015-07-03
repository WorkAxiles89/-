
<?php
$this->pageTitle = "Цены и наши проекты";
?>	
		
                
             <section class="section" id="project">
                    
                    <p class="section_menu"><a href="/index" class="botton_form f_left">На главную</a></p>
					<div class="container">                       
                        
						<div class="container_inner" style="border-top:1px solid black;">
                           
                            
							<div class="container_inner_header" class="f_left">
                                <h3 class="LazurskiC" style="">Цены</h3>
                                <h2 class="LazurskiCBold" style="">И наши проекты</h2>
                            </div>
                            <p class="container_inner_text f_left" style="">
                            С помощью нашей строительной компании, вы сможете подобрать любой проект по желанию: от маленького дачного домика до роскошной виллы в 400 кв.м. При этом, такое жилье будет стоить в два раза дешевле аналогичного кирпичного строения.
                            <br>Минимальная цена 1 кв.м. – всего от 13 500руб.
                            </p>
                            
                            
                             <?php foreach ($project as $key => $value):?>
                                
                                <div class="project_block f_left">
                                    <div class="f_right" style="width: 50%;">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Image/Project/<?php echo $value->img?>" data-lightbox="roadtrip">
                                            <img class="f_left" src="<?php echo Yii::app()->request->baseUrl; ?>/Image/Project/mini-<?php echo $value->img?>"/>
                                        </a>
                                    </div>
                                    <div class="project_blocktext" class="f_left">
                                    <p class="header_project LazurskiC">
                                        <a target="_blank" href="/projectview/<?php echo $value->id?>"><?php echo $value->title?></a>
                                    </p>
                                    <p class="project_textmini LazurskiC">
                                        <?php if (strlen($value->description) > 700):?>
                                            <?php echo substr($value->description, 0, 700).'...';?>
                                        <?php else:?>
                                            <?php echo $value->description?>
                                        <?php endif;?>
                                    </p>
                                    </div>
                                </div> 
                                
                            <?php endforeach;?>
                           
                          
                             <div class="content_block f_left">					
                            
                                <?php $this->widget('CLinkPager', array(
                                    'pages' => $pages,
                                    'header' => '',
                                    'firstPageLabel' => '<< Начало', 
                                    'prevPageLabel' => '< Предыдущая',
                                    'nextPageLabel' => ' Следующая >',
                                    'lastPageLabel' => ' Последняя >>',
                                    'maxButtonCount' => 6,
                                    'htmlOptions' => array('id' => 'paginator', 'class' => 'pager')
                                ))?>				
                                
                    
                                    
                            </div>
                           
						</div>
					</div>
				</section>
   