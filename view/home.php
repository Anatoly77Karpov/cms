<?php

//поодгружаем список постов из json-файла
$posts = json_decode(file_get_contents('posts.json'), true);

$ids = array_rand($posts, 3);


?>
<div class="blog-post">
  <h2 class="blog-post-title">Sample blog post</h2>
  <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

</div><!-- /.blog-post -->

<div class="blog-post">
  <h2 class="blog-post-title">Another blog post</h2>
  <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

  <p>I am ready for the road less traveled. Already <a href="#">brushing off the dust</a>. Yeah, you're lucky if
    you're on her plane. I used to bite my tongue and hold my breath. Uh, She’s a beast. I call her Karma (come
    back). Black ray-bans, you know she's with the band. I can't sleep let's run away and don't ever look back,
    don't ever look back.</p>
  <blockquote>
    <p>Growing fast into a <strong>bolt of lightning</strong>. Be careful Try not to lead her on</p>
  </blockquote>
  <p>I'm intrigued, for a peek, heard it's fascinating. Oh oh! Wanna be a victim ready for abduction. She's got
    that international smile, oh yeah, she's got that one international smile. Do you ever feel, feel so paper
    thin. I’m gon’ put her in a coma. Sun-kissed skin so hot we'll melt your popsicle.</p>
  <p>This is transcendental, on another level, boy, you're my lucky star.</p>
</div><!-- /.blog-post -->

<div class="blog-post">
  <h2 class="blog-post-title">New feature</h2>
  <p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

  <p>From Tokyo to Mexico, to Rio. Yeah, you take me to utopia. I'm walking on air. We'd make out in your
    Mustang to Radiohead. I mean the ones, I mean like she's the one. Sun-kissed skin so hot we'll melt your
    popsicle. Slow cooking pancakes for my boy, still up, still fresh as a Daisy.</p>
  <ul>
    <li>I hope you got a healthy appetite.</li>
    <li>You're never gonna be unsatisfied.</li>
    <li>Got a motel and built a fort out of sheets.</li>
  </ul>
  <p>Don't need apologies. Boy, you're an alien your touch so foreign, it's <em>supernatural</em>,
    extraterrestrial. Talk about our future like we had a clue. I can feel a phoenix inside of me.</p>
</div><!-- /.blog-post -->

<nav class="blog-pagination">
  <a class="btn btn-outline-primary" href="#">Older</a>
  <a class="btn btn-outline-secondary disabled">Newer</a>
</nav>