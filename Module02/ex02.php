<?php
$str1 = 'Đào tạo lập trình';
$str2 = 'PHP';

//Nối và hiển thị
echo $str1.' web với ngôn ngữ '.$str2.'<br/>';

//Nối và gán
$str = $str1.' '.$str2.'<br/>';
echo $str;

$str = 'Trung tâm đào tạo lập trình '.$str2;
echo $str;
echo '<br/>';

$str = "Trung tâm đào tạo lập trình {$str2}tại Hà Nội";
echo $str;

echo '<br/>';

$url = 'https://hoangan.net';
$imgUrl = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD;
$htmlOutput = '<a href="'.$url.'"><img src="'.$imgUrl.'"/></a>';

echo $htmlOutput;
echo '<br/>';

$authorUrl = 'https://hoangan.net/author/friendntt10';
$authorName = 'Hoàng An';
$postUrl = '#';
$dateTimeDisplay = '20/05/2020';
$dateTime = '2020-05-20T23:02:29+07:00';
$categoryName = 'Thủ thuật Wordpress';
$commentCount = 27;

$postMeta = '<ul class="post_meta">
    <li class="post_author">
        <a href="'.$authorUrl.'">'.$authorName.'</a>
    </li><!-- .post_author -->
    <li class="posted_date">
        <a href="'.$postUrl.'">
            <time class="entry-date published" datetime="'.$dateTime.'">'.$dateTimeDisplay.'</time>
        </a>
    </li><!-- .posted_date -->
    <li class="comments">
        <a href="'.$postUrl.'">'.$commentCount.'</a>
    </li><!-- .comments -->
    <li class="entry_cats">
        <a href="'.$postUrl.'" rel="category tag">'.$categoryName.'</a>
    </li><!-- .entry_cats -->
</ul>
';
echo $postMeta;

$number = 10;
$str = 'Đào tạo PHP';
$total = $number.$str;
var_dump($total);