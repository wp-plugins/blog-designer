<?php header("Content-type: text/css"); ?>
<?php include( '../../../../wp-load.php' );?>
<?php $settings							=	get_option( "wp_blog_designer_settings" );?>
<?php $background						=	$settings['template_bgcolor'];?>
<?php $color							=	$settings['template_ftcolor'];?>
<?php $titlecolor						=	$settings['template_titlecolor'];?>
<?php $contentcolor						=	$settings['template_contentcolor'];?>
<?php $readmorecolor						=	$settings['template_readmorecolor'];?>
<?php $readmorebackcolor					=	$settings['template_readmorebackcolor'];
$alterbackground =	$settings['template_alterbgcolor'];
$titlebackcolor =	$settings['template_titlebackcolor'];
        $social_icon_style = get_option('social_icon_style');  
        $template_alternativebackground = get_option('template_alternativebackground');
?>

/************************************* lightbreeze style *********************************/
<?php
if($template_alternativebackground == 0){
    ?>
.white-content .alternative-back , .blog_template.marketer.alternative-back{
    background: <?php  echo $alterbackground; ?>;
}
<?php 
}
?>
.blog_template{
	float:left;
	width:100%;
	margin-bottom:20px;
	border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
	background:<?php echo $background;?>;
	padding:15px 15px 0 15px;
	border:1px solid #ccc;
}
.blog_header{
	overflow:hidden;
}
.blog_header img{
	box-shadow:none;
    width:100%;
}
.blog_header h1{
    display:block;
    padding:3px 10px;
    background: <?php echo $titlebackcolor; ?>;
    margin:0;
    border-radius: 3px;
    line-height:normal;
}
.blog_header h1 a{
    text-decoration:none;
    text-transform:uppercase;
    color:<?php echo $titlecolor; ?>;
    line-height:21px;
}
.box-template a.more-tag{
    background-color: <?php echo $readmorebackcolor; ?>;
    color: <?php echo $readmorecolor; ?>;    
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 5px;
    float: right;    
}
.box-template a.more-tag:hover{
    background-color: <?php echo $readmorecolor; ?>;
    color: <?php echo $readmorebackcolor; ?>;
}
.box-template .post_content p{
    color: <?php echo $contentcolor; ?>;
}
.meta_data_box {
	float:left;
	margin:10px 0;
	border-bottom: 1px solid #CCCCCC;
	width: 100%;
	font-style:italic;
}
.meta_data_box [class^="icon-"], .meta_data_box [class*=" icon-"], .tags [class^="icon-"], .tags [class*=" icon-"] {
	background: url( ../images/glyphicons-halflings.png ) no-repeat 14px 14px;
	display: inline-block;
	height: 14px;
	line-height: 14px;
	vertical-align: text-top;
	width: 14px;
}
.meta_data_box .metadate {	
	float: left;	
	padding: 0 0 0 10px;
	width: 20%;
}
.meta_data_box .metauser {    
    float: left;    
    width: 20%;
}
.meta_data_box .metacats {	
	float: left;
	padding: 0 10px 0 10px;
	width: 45%;	
}
.meta_data_box .metacats a {
	text-decoration:none;
	color:<?php echo $color;?>;
}
.meta_data_box .metacomments {
	float: left;
	padding-left: 10px;
	width: 30%x;
}
.meta_data_box .metacomments a {
	text-decoration:none;
	color:<?php echo $color;?>;
}
.meta_data_box .icon-author-date {
	background-position: -168px 1px;
	margin-right:5px;
}
.metadate i{
    margin-right: 5px;
}
.mdate i{
    margin-right: 5px;
}
.meta_data_box span.calendardate {
	color:#6D6D6D;
	margin-left:18px;
	font-size:12px;
}
.meta_data_box span.calendardate i {
	margin-right: 5px;
}

.meta_data_box .icon-cats {
	background-position: -49px -47px;
}
.meta_data_box .icon-comment {
	background-position: -241px -119px;
}
.tags {	
	color:<?php echo $color;?>;
	padding:5px 10px;
	border-radius: 3px;
}
.tags .icon-tags {
	background-position: -25px -47px;
}
.tags a {
	color:<?php echo $color; ?>;
	text-decoration:none;
}
.post_content a,.post-content-body a{		
	color:<?php echo $color;?>;	
}
.post_content a:hover ,.post-content-body a:hover{	
	color:<?php echo $color;?>;
}
.wl_pagination_box.lightbreeze .wl_pagination span, .wl_pagination_box.lightbreeze .wl_pagination a{
    border-radius: 2px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
/******************************** classical style ************************************/

.blog_template.classical{
    background: none;
    border:none;
    border-bottom: 1px dashed rgb(204, 204, 204);
    border-radius: 0px;
    box-shadow: none;
    float: left;
    margin-bottom: 20px;
    padding: 5px;
    width: 100%;
}
.classical .blog_header img{
	box-shadow:none;
    width:30%;
    float:left;
	margin-right:10px;
}
.classical a.more-tag{
    background-color: <?php echo $readmorebackcolor; ?>;
    color: <?php echo $readmorecolor; ?>;
    border-radius: 5px;
    font-size: 14px;
    padding: 5px 10px;
    float: right;
}
.classical a.more-tag:hover{
    background-color: <?php echo $readmorecolor; ?>;
    color: <?php echo $readmorebackcolor; ?>;
}
.classical .post_content{
    margin-top: 5px;
}
.classical .blog_header h1{
    display: block;
    background:  <?php echo $titlebackcolor; ?>;
    border-radius:0px;
    padding:0 5px;
    line-height:normal;
}
.classical .blog_header h1 a{
    color:<?php echo $titlecolor; ?>;
}
.classical .post_content p{
    color: <?php echo $contentcolor; ?>;
}
.classical .blog_header .metadatabox{
	border-bottom: none;
    float: none;
    font-size: 13px;
    font-style:italic;
    margin: 5px 0;
    width: 100%;
}
.classical .blog_header .metadatabox .metacomments{
	float:right;    
    padding: 2px 5px;
    border-radius:5px;
}
.classical .blog_header .metadatabox .icon-date {
    background-position: -48px -24px;
    margin-right: 3px;
}
.classical .blog_header .tags{
    background: none;
    border-radius: 0px;
    padding: 0px;
    color: <?php echo $color;?>;
}
.classical .blog_header .tags a{
    color: <?php echo $color;?>;
    font-size: 13px;
}
.wl_pagination_box{
	float: left;
    width: 100%;
}
.wl_pagination_box .wl_pagination span, .wl_pagination_box .wl_pagination a{
    background: <?php echo $readmorebackcolor; ?>;
    display: inline-block;
    padding: 0 8px;
    color:<?php echo $readmorecolor; ?>;
    text-decoration:none;
    margin-right:5px;
}
.wl_pagination_box .wl_pagination span.current, .wl_pagination_box .wl_pagination a:hover{
    background: <?php echo $color;?>;
    color:<?php echo $background;?>;
}
.metacomments i{
    margin-right: 2px;
}
span.category-link a{
    color:<?php echo $color;?>;
}
/******************************** spektrum style ************************************/
.blog_template.spektrum{
    background: none;
    border: none;
    border-radius: 0px;
    box-shadow: none;
    padding: 0px;
    margin-bottom: 0px;
}
.social-component.spektrum-social{
   margin-bottom: 30px;
}
.spektrum img {
    box-shadow: none;
    border-radius: 0px;
    float:left;
    width:100%;
}
.spektrum .date {
    background: #212121;
    color: <?php echo $background;?>;
    display: block;
    float: left;
    font-size: 10px;
    margin: 5px;
    text-align: center;
    text-transform: uppercase;
    padding:5px;
}
.spektrum .number-date {
    display: block;
    font-size: 20px;
    line-height:14px;
    background: #212121;
    color: <?php echo $background;?>;
    padding:3px 5px;
}
.spektrum .blog_header{    
    box-shadow: 0 3px 5px rgba(196, 196, 196, 0.3);
    width:100%;
    position: relative;
}
.spektrum .blog_header h1{
    background: none;
    border-radius: 0px;
    display: inline-block;
    line-height: normal;
    margin: 0;
    padding: 3px 10px;
}
.spektrum .blog_header h1 a{
    color: <?php echo $titlecolor; ?>;
}
.spektrum .post_content{    
    padding: 10px;
    box-shadow: 0 3px 5px rgba(196, 196, 196, 0.3);
}
.spektrum .post_content p{
    margin: 0;
    padding:0px;
    color: <?php echo $contentcolor; ?>;
}
.spektrum .post-bottom {
    box-shadow: 0 -2px 5px rgba(196, 196, 196, 0.3);
    margin: 0 auto;
    padding: 10px 15px;    
    clear: both;
    margin: 0px;
    position: relative;
    width: 100%;
    float:left;
}
.spektrum .post-bottom .categories {    
    display: inline-block;
    text-transform: uppercase;
    margin-right: 20px;
    float: left;
}
.spektrum .post-by{
    text-transform: uppercase;
    margin-right: 15px;
}
.spektrum .tags{
    text-transform: uppercase;
}
.spektrum .post-bottom .post-by span {
    color: <?php echo $color;?>;    
}

.spektrum .post-bottom .categories a{
    color: <?php echo $color;?>;
    text-decoration: none;
}
.spektrum .post_content a{
	display: none;
}   
.spektrum .details a {
    color: inherit;
    display: inline-block;
    float: right;
    padding-right: 10px;
    text-decoration: none;
    text-transform: uppercase;
    color :<?php echo $readmorecolor; ?>;
}
.spektrum .details a:hover{
    color :<?php echo $readmorebackcolor; ?>;
}
.wl_pagination_box.spektrum .wl_pagination span, .wl_pagination_box.spektrum .wl_pagination a{
    display: inline-block;
    padding: 2px 10px;
    color:#fff;
    text-decoration:none;
    margin-right:0px;
}
.wl_pagination_box.spektrum .wl_pagination span{
    background: #212121;
}
.wl_pagination_box.spektrum .wl_pagination a{
	background: <?php echo $readmorecolor; ?>;
    color: #212121;
}
.wl_pagination_box.spektrum .wl_pagination span.current{
    background: <?php echo $readmorebackcolor; ?>;
    color: #fff;
}
.wl_pagination_box.spektrum .wl_pagination a:hover{
    color:<?php echo $color;?>;
}

/******************************** evolution style ************************************/
.blog_template.marketer{
    background: <?php echo $background; ?>;
    border: none;
    border-radius: 0px;
    box-shadow: 0 9px 6px -6px rgba(196, 196, 196, 0.3);
    padding: 10px;
}
.marketer .post-category,.marketer .post-title, .post-entry-meta{
    text-align: center;
}
.marketer .post-title{
    margin-bottom: 5px;
    margin-top: 5px;
    padding: 5px 0;
    background: <?php echo $titlebackcolor; ?>;
}
.marketer .post-title a{
    text-transform: uppercase;
    color: <?php echo $titlecolor; ?>;
    
}
.post-image{
 margin-top: 10px;
}
.marketer .post-content-body{
    width: 100%;
    float: left;
    margin-top:10px;
}
.marketer .post-bottom a{
    background: <?php echo $readmorebackcolor;  ?>;
    color: <?php echo $readmorecolor;  ?>;
}
.marketer .post-bottom a:hover{
    background:<?php echo $readmorecolor;  ?>;
    color:<?php echo $readmorebackcolor;  ?>;
}

.marketer .post-content-body p{
    color: <?php echo $contentcolor; ?>;
}
.marketer .author{
    text-transform: uppercase;
    font-size: 15px;
}

.marketer .post-category a{
    color: <?php echo $color; ?>;
    font-size: 14px;
    text-transform: uppercase;    
}

.marketer img {
    box-shadow: none;
    border-radius: 0px;
    float:left;
    width:100%;
}
.marketer .date {        
    font-size: 15px;
    margin: 0px;
    text-align: center;
    text-transform: uppercase;
    padding:10px;
    width: 9%;
}
.marketer .number-date {
    line-height:14px;    
    padding:3px 5px;
}
.marketer .tags{
    font-size: 15px;
    text-transform: uppercase;
}
.marketer .tags .icon-tags{
    margin-top: 4px;
}
.marketer .icon_cnt{    
    font-size: 15px;
    margin-left: 12px;
}
.marketer .icon_cnt i{    
    margin-right: 4px;
}
.marketer .icon_cnt a{
    color: <?php echo $color;?>;
    text-decoration:none;
}
.marketer .blog_header{
    background: <?php echo $background;?>;
    width:100%;
    position: relative;
}
.marketer .blog_header .title{
    float:left;
    width:81.5%;
    width:81.45%\0/;
}
.marketer .blog_header h1{
    background: none;
    border-radius: 0px;
    display: block;
    line-height: normal;
    padding: 6px 10px;
    border-bottom: 1px dotted #CCCCCC;
    margin:0 0 5px 0;
}
.marketer .blog_header h1 a{
    color: <?php echo $color;?>;
    text-transform:none;
}
.marketer .blog_header .title .metadate{
    font-size: 12px;
    font-style: italic;
    padding: 0 10px;
}
.marketer .blog_header .title .metadate a{
	color: <?php echo $color;?>;
}
.marketer .blog_header .title .metadate a:hover{
    color: #212121;
    text-decoration:none;
}
.marketer .blog_header .title .metadate span.author, .marketer .blog_header .title .metadate span.time{
    color: <?php echo $color;?>;
}
.marketer .post_content{
    background: none ;
    padding: 10px;
	border:2px solid <?php echo $background;?>;
    border-bottom:none;
}
.marketer .post_content p{
    margin: 0;
    padding:0px;
}
.marketer .post-bottom {    
    float: left;
    width: 100%;
}
.marketer .post-bottom a{
    float: right;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
}
.marketer .post-bottom .categories {
    color: <?php echo $color;?>;
    display: inline-block;
    text-transform: uppercase;
}
.marketer .post-bottom .categories a{
    color: <?php echo $color;?>;
    text-decoration: none;
}
.marketer .post_content a{
	display: none;
}   
.marketer .details a {
    color: inherit;
    display: inline-block;
    float: right;
    padding-right: 10px;
    text-decoration: none;
    text-transform: uppercase;
}
.wl_pagination_box.evolution{
    width: 97.5%;
}
.wl_pagination_box.evolution .wl_pagination{
    float: right;
}
.wl_pagination_box.evolution .wl_pagination span, .wl_pagination_box.evolution .wl_pagination a{
    display: inline-block;
    padding: 2px 10px;
    color:#fff;
    text-decoration:none;
    margin:0 0 0 8px;
}
.wl_pagination_box.evolution .wl_pagination span{
    background: <?php echo $readmorebackcolor; ?>;
    color:#fff;
}
.wl_pagination_box.evolution .wl_pagination a{
	background: <?php echo $readmorebackcolor;?>;
    color: #fff;
}
.wl_pagination_box.evolution .wl_pagination span.current{
    background: <?php echo $color;?>;
    color:<?php echo $background;?>;
}
.wl_pagination_box.evolution .wl_pagination a:hover{
    background :<?php echo $color;?>;
}

span.facebook-share{
    background: none repeat scroll 0 0 #3a589d;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.twitter{
    background: none repeat scroll 0 0 #2478ba;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.google{
    background: none repeat scroll 0 0 #dd4e31;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.linkedin{
    background: none repeat scroll 0 0 #0072b7;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.pinterest{
    background: none repeat scroll 0 0 #cb2320;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.dribble{
    background: none repeat scroll 0 0 #e5086f;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
span.instagram{
    background: none repeat scroll 0 0 #e5086f;
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    text-align: center;
}
.social-component{
    margin: 15px 0;
    width: 100%;
    float: left;
}
<?php if($social_icon_style == 0){ ?>
.social-component a {
    border: 1px solid #cccccc;
    border-radius: 100%;
    float: left;
    height: 38px;
    margin-bottom: 8px;
    margin-right: 8px;
    padding: 8px 0;
    text-align: center;
    width: 38px;
    font-size: 15px;
    line-height:20px;
}
<?php } if($social_icon_style == 1){  ?>
.social-component a {
    border: 1px solid #cccccc;
    float: left;
    height: 38px;
    margin-bottom: 8px;
    margin-right: 8px;
    padding: 8px 0;
    text-align: center;
    width: 38px;
    font-size: 15px;
    line-height:20px;
}
<?php } ?>
.social-component a.facebook-share:hover{
    background: none repeat scroll 0 0 #3a589d;
    border-color: #3a589d;
    color: #fff;
}
.social-component a.twitter:hover{
    background: none repeat scroll 0 0 #2478ba;
    border-color: #2478ba;
    color: #fff;
}
.social-component a.google:hover{
    background: none repeat scroll 0 0 #dd4e31;
    border-color: #dd4e31;
    color: #fff;
}
.social-component a.linkedin:hover{
     background: none repeat scroll 0 0 #cb2320;
    border-color: #cb2320;
    color: #fff;
}
.social-component a.instagram:hover{
    background: none repeat scroll 0 0 #111111;
    border-color: #111111;
    color: #fff;
}
.social-component a.pinterest:hover{
     background: none repeat scroll 0 0 #cb2320;
    border-color: #cb2320;
    color: #fff;
}
