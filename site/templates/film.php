<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php snippet('header') ?>
    <?php echo $page->metaTags() ?>
  </head>

  <body>
    <div id="app" class="film-container">
      <div class="left">
        <div style="background-color: <?= $page->firstcolor() ?>" class="square date">
          <?php if ($page->featured()->toBool() === true): ?>
            Now Showing
          <?php endif ?>
          <?php if ($page->featured()->toBool() === false): ?>
              <?= $page->end()->toDate('d.m.y') ?>
          <?php endif ?>
        </div>
        <div style="background-color: <?= $page->secondcolor() ?>" class="square watch"></div>
        <div @mouseover="hoverAbout = true"
             @mouseleave="hoverAbout = false"
             style="background-color: <?= $page->secondcolor() ?>"
             class="square about">
          <div v-if="!hoverAbout" id = about-button>About</div>
          <div v-if="hoverAbout" id = about-text>
            <?= $pages->find('home')->aboutcineola()->kt(); ?>
          </div>
        </div>
        <div style="background-color: <?= $page->firstcolor() ?>" class="square logo">
          <a href="<?= $site->homePage()->url()?>">
            <img src="<?php echo url('assets/img/cineola-logo.svg') ?>" alt="">
          </a>
        </div>
        <div style="background-color: <?= $page->firstcolor() ?>" class="square email">
          <form
          class="form validate"
          action="https://cineo.us8.list-manage.com/subscribe/post?u=60b50e59f99c5078b67ff4cbb&amp;id=acc3e72c0c"
          method="post"
          id="mc-embedded-subscribe-form"
          name="mc-embedded-subscribe-form"
          target="_blank"
          novalidate
          >
          <input type="text" value name="EMAIL" placeholder="EMAIL" required />
          <button style="color: <?= $page->firstcolor() ?>" id="mc-embedded-subscribe" class="btn" type="submit">
            SUBSCRIBE
          </button>
        </form>
        </div>
        <div style="background-color: <?= $page->secondcolor() ?>" class="square about social-container" @mouseover="hoverSocial = true"
             @mouseleave="hoverSocial = false">
          <div v-if="!hoverSocial" id = about-button>Social</div>
          <div v-if="hoverSocial" class="social-links">
            <a target="_blank" href="https://www.instagram.com/cineolafilms/">Instagram</a>
            <a target="_blank" href="https://twitter.com/Cineola">Twitter</a>
            <a target="_blank" href="https://www.facebook.com/cineola">Facebook</a>
            <a target="_blank" href="https://www.youtube.com/channel/UCzRZKq7tACqMvl_aQXA3qrw">Youtube</a>
            <a target="_blank" href="https://open.spotify.com/show/4nZSKVjU21F7rks0aqW2Bm">Spotify</a>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="grotzec inner-right">
          <div class="header">
            <h3 style="color: <?= $page->secondcolor() ?>"><span style="text-transform: none !important">CiNEOLA</span>
              <?php if ($page->presenters()->isEmpty() === false): ?>
                  <?php foreach ($page->presenters()->toStructure() as $presenter): ?>
                      + <?= $presenter->presenter() ?>
                  <?php endforeach ?>
              <?php endif ?>
              Presents
            </h3>
            <br>
            <h1 style="color: <?= $page->secondcolor() ?>"><?= $page->title() ?></h1>
          </div>
          <br>
          <div class="film-embed">
            <div class="film-embed-text">
              <div class="">
                <?= $page->location() ?>
              </div>
              <div class="">
                <?= $page->director() ?>
              </div>
            </div>
            <br>
            <div class="film-embed-iframe">
              <?= $page->filmembed() ?>
            </div>
          </div>
          <br>
          <br>
          <div class="about-container">
            <br>
            <br>
            <div class="about-container-text">
              <div class="about-synopsis">
                <strong style="text-decoration: underline">Synopsis</strong>
                <br>
              <div style="padding-top: 1vh"> <?= $page->synopsis()->kt() ?></div>
              </div>
              <br>
              <br>
              <?php if ($page->directorstatement()->isEmpty() === false): ?>
              <div class="about-statement">
                <strong style="text-decoration: underline">Director's Statement</strong>
                <div style="padding-top: 1vh"> <?= $page->directorstatement()->kt()->nl2br() ?></div>
              </div>
              <!-- <br> -->
              <?php endif ?>
              <!-- <br> -->
              <div class="about-links">
                <?php if ($page->externallinks()->isEmpty() === false): ?>
                  <br>
                  <br>
                  <strong style="text-decoration: underline">Links</strong>
                  <ul>
                    <?php foreach ($page->externallinks()->toStructure() as $externallink): ?>
                      <li style="padding-top: 1vh">
                        <a target="_blank" href="<?= $externallink->link() ?>">
                          <?= $externallink->title() ?>
                        </a>
                      </li>
                    <?php endforeach ?>
                  </ul>
                <?php endif ?>

                <?php if ($page->press()->isEmpty() === false): ?>
                  <br>
                  <br>
                  <strong style="text-decoration: underline">Press</strong>
                  <ul>
                    <?php foreach ($page->press()->toStructure() as $press): ?>
                    <li style="padding-top: 1vh">
                      <a target="_blank" href="<?= $press->link() ?>">
                        <?= $press->title() ?>
                      </a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                <?php endif ?>
                <br>
              </div>
            </div>
            <br>
          </div>
          <br>
          <br>
          <div class="about-credits-container">
            <div class="about-credits">
              <strong style="text-decoration: underline">Credits</strong>
              <div style="padding-top: 1vh"><?= $page->credits()->kt()?></div>
            </div>
          </div>
          <br>
          <br>
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  var app = new Vue({
    el: '#app',
    data: {
      hoverAbout: false,
      hoverSocial: false
    }
  })
</script>

<style>
  strong {
    text-transform: uppercase;
  }
  @media only screen and (max-width: 1024px) {
    .film-container {
      display: flex;
      flex-direction: column-reverse;
    }
  }

    .left {
      position: fixed;
      color: var(--cineola-black);
      display: grid;
      grid-template-columns: repeat(2, 50%);
      grid-template-rows: repeat(3, calc(100vh / 3));
      width: 40%;
    }
    @media only screen and (max-width: 1024px) {
      .left {
        position: relative;
        color: var(--cineola-black);
        display: grid;
        grid-template-columns: repeat(2, 50%);
        grid-template-rows: repeat(3, calc(100vh / 3));
        width: 100%;
      }
    }

      .square {
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Grotzec;
        text-transform: uppercase;
        font-size: var(--grotzec-text-size);
        font-weight: 100;
      }

      .date {
        font-family: Nayarit;
        text-transform: none !important;
        font-size: 4.5vw;
      }
      @media only screen and (max-width: 1024px) {
        .date {
          font-size: 3em;
        }
      }

      .logo a {
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
      }

      .logo img {
        width: 15vw;
      }
      @media only screen and (max-width: 1024px) {
        .logo img {
          width: 10em;
        }
      }

      #about-text {
        width: 90%;
        text-transform: none !important;
      }
      @media only screen and (max-width: 1024px) {
        .about {
          font-size: var(--mobile-text-size);
        }
      }

      .social-container {
        height: 100%;
      }

      .social-links {
        display: flex;
        flex-direction: column;
        height: 90%;
        justify-content: space-around;
        align-items: center;
      }

      @media only screen and (max-width: 1024px) {
        .social-links {
          font-size: var(--mobile-text-size);
        }
      }

      .right {
        margin-left: 40%;
        display: flex;
        /* justify-content: space-around; */
        flex-direction: column;
        align-items: center;
        width: 60%;
        background-color: var(--cineola-black);
      }
      @media only screen and (max-width: 1024px) {
        .right {
          margin-left: 0;
          width: 100%;
        }
      }

        .inner-right {
          display: flex;
          flex-direction: column;
          align-items: center;
          width: 90%;
          padding-top: 2.5vw;
          /* background-color: red; */
        }
        @media only screen and (max-width: 1024px) {
          .inner-right {
            padding-top: 5vh;
          }
        }

          .header {
            display: flex;
            flex-direction: column;
            align-items: center;
          }

            .header h3 {
              text-transform: uppercase;
              font-family: Grotzec;
              color: <?= $page->secondcolor() ?>;
            }

            .header h1 {
              text-align: center;
              font-family: Nayarit;
              font-size: 10em;
            }
            @media only screen and (max-width: 1024px) {
              .header h3 {
                font-size: var(--mobile-text-size);
              }

              .header h1 {
                font-size: 7.5em;
              }
            }

            .film-embed {
              text-transform: uppercase;
              width: 100%;
              display: flex;
              flex-direction: column;
              justify-content: space-between;
              color: <?= $page->secondcolor() ?>;
            }

              .film-embed-text {
                display: flex;
                width: 100%;
                justify-content: space-between;
                color: <?= $page->secondcolor() ?>;
              }

              .film-embed-iframe {
                position: relative;
                width: 100%;
                overflow: hidden;
                padding-top: 56.25%; /* 16:9 Aspect Ratio */
              }
              @media only screen and (max-width: 1024px) {
                .film-embed-text {
                  font-size: var(--mobile-text-size);
                  padding-bottom: 1vh;
                }

                .film-embed-iframe {
                  padding-top: 56.25%; /* 16:9 Aspect Ratio */
                }
              }

                iframe {
                  position: absolute;
                  top: 0;
                  left: 0;
                  bottom: 0;
                  right: 0;
                  width: 100%;
                  height: 100%;
                  border: none;
                }

          .about-container {
            /* text-transform: uppercase; */
            text-align: justify;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: <?= $page->secondcolor() ?>;
          }

            .about-container-text {
              width: 92.5%;
            }

            .about-credits-container {
              text-align: justify;
              width: 100%;
              display: flex;
              justify-content: center;
              color: <?= $page->secondcolor() ?>;
            }

            .about-credits {
              width: 92.5%;
            }

            .about-credits p {
              display: inline;
            }

            @media only screen and (max-width: 1024px) {
              .about-container {
                margin-top: 2.5vh;
                padding-top: 1vh;
                margin-bottom: 2.5vh;
              }

              .about-container-text, .about-credits-container {
                font-size: var(--mobile-text-size);
              }
              p {
                /* line-height: 3.5vh; */
              }
            }

    /**** FORM ****/
    .form {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    @media only screen and (max-width: 1024px) {
      .form {
        flex-direction: row;
        width: 80%;
      }
    }

    input {
      width: 8vw;
      font-size: var(--grotzec-text-size);
      font-family: Grotzec;
      font-weight: 100;
      padding: 1vw;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 0;
      border: 1px solid #232323;
      outline: none;
      color: var(--cineola-black);
      background-color: transparent;
    }
    @media only screen and (max-width: 1024px) {
      input {
        width: 100%;
        font-size: var(--mobile-text-size);
      }
    }

    /* Change autocomplete styles in WebKit */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
      border: 1px solid #232323;
      -webkit-text-fill-color: #232323;
      -webkit-box-shadow: 0 0 0px 1000px transparent inset;
      transition: background-color 5000s ease-in-out 0s;
    }

  ::placeholder {
    color: var(--cineola-black);
    opacity: 1; /* Firefox */
  }

  .btn {
    width: 5.5vw;
    display: flex;
    justify-content: center;
    font-size: var(--grotzec-text-size);
    font-family: Grotzec;
    padding: 1vw;
    border: 1px solid #232323;
    cursor: pointer;
    background-color: #232323;
    outline: none;
  }
  @media only screen and (max-width: 1024px) {
    .btn {
      width: 100%;
      font-size: var(--mobile-text-size);
    }
  }

  .btn:hover {
    text-decoration: underline;
  }
  /**** END FORM ****/

</style>
