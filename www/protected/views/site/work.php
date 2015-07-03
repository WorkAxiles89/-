
<?php
$this->pageTitle = "Примеры работ";
?>	
		
                
           
                <section class="section" id="work">
                    
                    <p class="section_menu"><a href="/index" class="botton_form f_left">На главную</a></p>
					<div class="container">                       
                        
						<div class="container_inner">
                           
                            
                            <div class="container_inner_header" class="f_left">
                                <h3 class="LazurskiC">Наши</h3>
                                <h2 class="LazurskiCBold">Примеры работ</h2>
                            </div>
                            <p class="container_inner_text f_left">
                              Здесь вы можете ознакомиться с нашими готовыми работами. 
                            </p>
                           

                            <?php foreach ($work as $key => $value):?>
                                <div class="work_block <?php if ($key % 2 == 0):?>f_left<?php else:?>f_right<?php endif?>">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/Image/Work/<?php echo $value->img?>" data-lightbox="roadtrip">
                                        <img width="360" class="f_left" border="0" src="<?php echo Yii::app()->request->baseUrl; ?>/Image/Work/mini-<?php echo $value->img?>"/>
                                    </a>
                                <p class="header_work LazurskiC f_left">
                                    <a target="_blank" href="/workview/<?php echo $value->id?>"><?php echo $value->title?></a>
                                </p>
                                <p class="work_textmini LazurskiC f_left">                
                                    <?php echo $value->description?>
                                </p>
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