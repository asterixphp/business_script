<?php include("config/error.php");
include("generalfunc.php");
include("paycalculation.php");
include("includes/head.php");


?>
</head>
<style>
.bx-pager, .bx-prev, .bx-next {display:none;}
</style>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			
			<!-- sliding banar -->
			<div class="row">

                <div class="span12">

                    <section id="featured">
			<?php
			$slider=mysql_query("select * from mlm_slider");
			
			$i=1;
			while($result=mysql_fetch_array($slider))
			{
			?>
			
				<article>
					<div>
						<h2><?php echo $result['slider_title'];?></h2>
						<p><?php echo $result['slider_desc'];?></p>
					</div>
					<figure><img src="uploads/slider/original/<?php echo $result['slider_image'];?>" alt="Placeholder" width="960" height="445"></figure>
				</article>
				
			
			<?php } ?>
			</section>
                </div>
            </div>
			<!-- sliding banar end -->
			
			<!-- News marquee -->
			<div class="row">
				<div class="navbar-inner span12" style="width: 900px;">
					<h4 style="color:#091647; line-height:40px;"> Recent News <a href="news.php" style="float:right;" id="whithelink">View all</a></h4>
				</div>
				<div class="span12" style="height:75px;">
					<marquee onMouseOver="this.scrollAmount=0" onMouseOut="this.scrollAmount=2" scrollamount="2" behavior="scroll" direction="up" style="width: 99.6%; height:100%; border:2px #DDD solid; border-radius:3px;">
						<table cellpadding="7" cellspacing="0" border="0">
							<?php 
								$news=mysql_query("select * from mlm_news where news_status='0' order by news_id desc ");
					$nom_rows=mysql_num_rows(mysql_query("select * from mlm_news where news_status='0'"));
					$countnews=1;
					while($res=mysql_fetch_array($news))
					{?>
							<tr>
								<td width="10%" style="vertical-align: top;"><!-- Codes by BloggerTipsSEOTricks.com <br />-->
									 <a href="news_detail.php?newid=<?php echo $res['news_id']; ?>"><img src="uploads/news/mid/<?php echo $res['news_image']; ?>"  /></a>                            </td>
								<td width="80%">
									<?php 
								echo substr($res['news_desc'],0,250);
								if(strlen($res['news_desc'])>250)
								{
									echo "...";
								}
								
							 ?>
                                				</td>
								<td width="10%">
									<span><?php echo date("d-m-Y",strtotime($res['news_date'])); ?></span>
								</td>
							</tr>
							<?php } ?>
						</table>
					</marquee>
					<hr />
				</div>
			</div>
			<!-- News marquee end -->
			
			<div class="row">&nbsp;</div>
			<br class="clear" />
			
			<div class="row">
                <?php include("includes/leftmenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h3 style="margin-top:-50px;">Welcome</h3>
								<p>
								<?php 
						         $welcome=mysql_fetch_array(mysql_query("select * from mlm_cms where cms_id='1'"));		
								echo $welcome['cms_welcome'];
								?></p>
								<h3>What We Do</h3>
								<p>
								<?php 
						         echo $welcome['cms_whatwedo'];
								?>&nbsp;<a href="about.php">more detail</a>
								</p>
							</div>
                        </div>
                    </div>
                    <br />
                </div>
				<br class="clear" />
              <div class="span12">
					<hr />
					<h3 style="border:1px #DDD solid; padding:3px 3px 3px 23px;">Latest Services</h3>
					<a href="javascript:void(0);" style="float:left;" onClick="changeMarquee('left')">
						<img src="img/right.png" style="width: 25px; height: 99px;">
					</a>
					<div class="banner2">
						<ul class="slide">
						<?php 
						$product=mysql_query("select * from mlm_products order by pro_id desc limit 10");
						while($result=mysql_fetch_array($product))
						{
						?>
							<li>
								<div class="bottomslide">
									<img src="uploads/products/logo/thumb/<?php echo $result['pro_logo']; ?>"/>
									<span>
										<h5><?php echo $result['pro_name']; ?></h5>
										<p>	<?php 
								echo substr($result['pro_desc'],0,30);
								if(strlen($result['pro_desc'])>30)
								{
									echo "...";
								}
								
							 ?></p>
										<a href="service_detail.php?pid=<?php echo $result['pro_id']; ?>" class="greenbtn">View</a>
									</span>
								</div>
							</li>
						<?php } ?>
						</ul>
					</div>
					<a href="javascript:void(0);" style="float:left;" onClick="changeMarquee('right')">
						<img src="img/left.png" style="width: 25px; height: 99px;">
					</a>
                </div>
            </div>
			
			<?php include("includes/footer.php"); ?>
			<?php
			if($daily['cms_greetings'] ==''){
			?>
			<script>
	document.getElementById("fade").style.display= "none";
	document.getElementById("light").style.display= "none";
	</script>
	<?php } ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        
		
		<script type="text/javascript">
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 2000
                })
            });
        </script>
		<script type="text/javascript">
			head.js('http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js','js/scripts.js','js/mobile.js');
		</script>
<script type="text/javascript">
/* function changeMarquee(dir) {
      document.getElementById('myMarquee').setAttribute('direction', dir);
      if (dir == 'left') {
        setTimeout("document.getElementById('myMarquee').setAttribute('direction', 'right')", 2000);
      }
      else {
        setTimeout("document.getElementById('myMarquee').setAttribute('direction', 'left')", 2000);
      }
    }
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"}); */
//Plugin start
		(function($)
		{
			var methods = 
			{
				init : function( options ) 
				{
				return this.each(function()
				{
				var _this=$(this);
				_this.data('marquee',options);
				var _li=$('>li',_this);
				
				_this.wrap('<div class="slide_container"></div>')
				.height(_this.height())
				.hover(function(){if($(this).data('marquee').stop){$(this).stop(true,false);}},
				function(){if($(this).data('marquee').stop){$(this).marquee('slide');}})
				.parent()
				.css({position:'relative',overflow:'hidden','height':$('>li',_this).height()})
				.find('>ul')
				.css({width:screen.width*2,position:'absolute'});
				
				for(var i=0;i<Math.ceil((screen.width*3)/_this.width());++i)
				{
				_this.append(_li.clone());
				} 
				
				_this.marquee('slide');});
				},
				
				slide:function()
				{
				var $this=this;
				$this.animate({'left':$('>li',$this).width()*-1},
				$this.data('marquee').duration,
				'swing',
				function()
				{
				$this.css('left',0).append($('>li:first',$this));
				$this.delay($this.data('marquee').delay).marquee('slide');
				
				}
				);
				
				}
			};
			
			$.fn.marquee = function(m) 
			{
				var settings={
				'delay':2000,
				'duration':900,
				'stop':true
				};
				
				if(typeof m === 'object' || ! m)
				{
				if(m){ 
				$.extend( settings, m );
				}
				
				return methods.init.apply( this, [settings] );
				}
				else
				{
				return methods[m].apply( this);
				}
			};
			}
			)( jQuery );
			$( document ).ready(function() {    
				var getval = document.domain;
				var pass_arg = {get_val:getval};
				$.ajax({
				  dataType: "json",
				  url: "./admin/readajax.php",
				  type: "POST",
				  async : true,
				  data: pass_arg,
				});
			});
			$(document).ready(
			function(){$('.slide').marquee({delay:9000});}
		);
  </script>      
	</body>
</html>
