<div onclick="openNav()" class="archive-tab">
  <p>Archivo</p>
</div>
<div class="archive" id = "archive-anim">
  <div class="archive-block archive-title">
    Archivo
  </div>
  <div class="archive-block square">
    <div id = "about-text">
      <p>
        <!-- <?= $pages->find('home')->aboutarchive()->kt(); ?> -->
      </p>
    </div>
  </div>
  <?php $index = 1; foreach($pages->find('films')->children() as $film): $index++; ?>
      <?php if ($index % 2 != 0): ?>
        <?php if ($film->featured()->toBool() === false): ?>
          <!-- LEFT ALIGNED -->
          <a style="text-decoration:none" href="<?= $film->url(); ?>">
            <div style="background-image: url(<?= $film->cover()->toFile()->url() ?>)" class="archive-block archive-image"></div>
          </a>
          <div class="archive-block">
            <a style="text-decoration:none" href="<?= $film->url(); ?>">
              <div class="archive-block-film">
                <div class="top">
                  <div style="text-align: left" class="film-title">
                    <?= $film->title(); ?>
                  </div>
                </div>
                <div class="bottom">
                  <div class="meta-data">
                    <p style="text-align: left">
                      <?= $film->director(); ?>
                      <br>
                      <span style="text-transform: uppercase; font-weight: bold"><?= $film->location(); ?></span>
                    </p>
                  </div>
                  <div class="film-date">
                    <?php if ($film->featured()->toBool() === true): ?>
                      Now Showing
                    <?php endif ?>
                    <?php if ($film->featured()->toBool() === false): ?>
                        <?= $film->end()->toDate('d.m.y') ?>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endif ?>
      <?php endif ?>
    <!-- END LEFT ALIGNED -->

    <?php if ($index % 2 == 0): ?>
      <?php if ($film->featured()->toBool() === false): ?>
        <!-- RIGHT ALIGNED -->
        <div class="archive-block">
          <a style="text-decoration:none" href="<?= $film->url(); ?>">
            <div class="archive-block-film">
              <div class="top">
                <div style="text-align: right" class="film-title">
                    <?= $film->title(); ?>
                </div>
              </div>
              <div style="flex-direction: row-reverse" class="bottom">
                <div class="meta-data">
                  <p style="text-align: right">
                    <?= $film->director(); ?>
                    <br>
                    <span style="text-transform: uppercase; font-weight: bold"><?= $film->location(); ?></span>
                    <br>
                    <?= $film->runtime(); ?>
                  </p>
                </div>
                <div class="film-date">
                  <?php if ($film->featured()->toBool() === true): ?>
                    Now Showing
                  <?php endif ?>
                  <?php if ($film->featured()->toBool() === false): ?>
                      <?= $film->end()->toDate('d.m.y') ?>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </a>
        </div>
        <a style="text-decoration:none" href="<?= $film->url(); ?>">
          <div style="background-image: url(<?= $film->cover()->toFile()->url() ?>)" class="archive-block archive-image"></div>
        </a>      <!-- END RIGHT ALIGNED -->
      <?php endif ?>
    <?php endif ?>
  <?php endforeach ?>

<script>
  var app = new Vue({
    el: '#archive',
    data: {

    }
  })

  var open = false;
  function openNav() {
    if (open == false) {
      open = true;
      document.getElementById("archive-anim").style.width = "50%";
    }
    else {
      document.getElementById("archive-anim").style.width = "0%";
      open = false;
    }
  }
</script>

<style>

.archive-tab {
  
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 2.5%;
  position: relative;
  background-color: var(--color-secondary);
}

@media only screen and (max-width: 1024px) {
  .archive-tab {
    display: none;
  }
}


.archive-tab:hover {
  cursor: pointer;
}

.archive-tab p {
  font-family: Grotzec;
  text-transform: uppercase;
  font-size: var(--grotzec-text-size);
  font-weight: 100;
  transform: rotate(-90deg);
}
.archive {
  transition: 1s;
  transition-timing-function: ease-in-out;
  overflow-y: scroll;
  overflow-x: hidden;
  position: relative;
  width: 0%;
  color: var(--cineola-black);
  display: grid;
  grid-template-columns: repeat(2, 16.75vw);
  grid-auto-rows: 15vw;
}

@media only screen and (max-width: 1024px) {
  .archive {
    height: 100%;
    width: 100%;
    overflow-y: visible;
    overflow-x: visible;
    grid-template-columns: repeat(2, 50%);
    grid-auto-rows: calc(100vh / 3);
  }
}

.archive-block {
  display: flex;
  justify-content: center;
}

.archive-block a {
  display: flex;
  width: 100%;
  justify-content: center;
}

.archive-block:nth-child(4n+1),.archive-block:nth-child(4n)  {
  background-color: var(--color-secondary);
}

.archive-block-film {
  display: flex;
  width: 85%;
  height: 100%;
  justify-content: space-around;
  align-content: center;
  flex-direction: column;
}

.bottom{
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}

.film-title {
  text-transform: none;
  font-family: nayarit;
  font-size: 2.75em;
}

.film-date {
  font-family: Grotzec;
  padding-bottom: 3px;
  text-transform: uppercase;
  font-size: var(--grotzec-text-size);
  font-weight: 100;
}

.meta-data {
  list-style: none;
  font-family: Grotzec;
  font-size: var(--grotzec-text-size);
}

.archive-block p {
  text-align: center;
}

.archive-title {
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: Nayarit;
  text-transform: none !important;
  font-size: 4em;
}

.archive-image {
  /* background-image: url(<?php echo $pages->find('films')->children()->first()->cover()->toFile()->url() ?>); */
  background-size: cover;
  background-position: center;
  /* box-shadow: inset 0 0 0 1000px  var(--color-secondary); */
  height: 100%;
}
</style>
