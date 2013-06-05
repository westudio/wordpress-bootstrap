<?php

/**
 * Template Name: Testing Page
 */

?>
<?php
if (bootstrap_has_layout()):
  get_header();
endif;
?>

    <div class="container">

      <section id="breadcrumbs">

        <div class="page-header">
          <h1>Breadcrumbs</h1>
        </div>

        <ul class="breadcrumb">
          <li><a href="#">Home</a> <span class="divider">/</span></li>
          <li><a href="#">Library</a> <span class="divider">/</span></li>
          <li class="active">Data</li>
        </ul>

      </section>

      <section id="nav">

        <div class="page-header">
          <h1>Nav</h1>
        </div>

      </section>

      <section id="navbar">

        <div class="page-header">
          <h1>Navbar</h1>
        </div>

        <div class="navbar">
          <div class="navbar-inner">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>

            <a class="brand" href="#"><?php echo get_bloginfo('name'); ?></a>

            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>

            <?php bootstrap_navbar_search_form(); ?>

          </div>
        </div>

      </section>

      <section id="typography">

        <div class="page-header">
          <h1>Typography</h1>
        </div>

        <h2>Hero unit</h2>

        <div class="hero-unit">
          <h1>Hello, world!</h1>
          <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
          <p><a class="btn btn-primary btn-large">Learn more</a></p>
        </div>

        <h2>Examples</h2>

        <div class="row-fluid">
          <div class="span4">
            <div class="well">
              <h1>Heading 1</h1>
              <h2>Heading 2</h2>
              <h3>Heading 3</h3>
              <h4>Heading 4</h4>
              <h5>Heading 5</h5>
              <h6>Heading 6</h6>
            </div>
          </div>
          <div class="span4">
            <h3>Example text</h3>
            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
          </div>
          <div class="span4">
            <h3>Exemple addresses</h3>
            <address>
              <strong>We studio, sàrl</strong><br />
              Rue des Côtes-de-Montbenon, 30<br />
              CH-1003 Lausanne<br />
            </address>
            <address>
              Full name
              <a href="mailto:#">first.last@we-studio.ch</a>
            </address>
          </div>
        </div>

      </section>

      <section id="buttons">

        <div class="page-header">
          <h1>Buttons</h1>
        </div>

        <table>
          <tbody>
            <tr>
              <td><a class="btn" href="#">Default</a></td>
              <td><a class="btn btn-large" href="#">Default</a></td>
              <td><a class="btn btn-small" href="#">Default</a></td>
              <td><a class="btn disabled" href="#">Default</a></td>
              <td><a class="btn" href="#"><i class="icon-cog"></i> Default</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn" href="#">Default</a>
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
            <tr>
              <td><a class="btn btn-primary" href="#">Primary</a></td>
              <td><a class="btn btn-primary btn-large" href="#">Primary</a></td>
              <td><a class="btn btn-primary btn-small" href="#">Primary</a></td>
              <td><a class="btn btn-primary disabled" href="#">Primary</a></td>
              <td><a class="btn btn-primary" href="#"><i class="icon-shopping-cart icon-white"></i> Primary</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-primary" href="#">Primary</a>
                  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
            <tr>
              <td><a class="btn btn-info" href="#">Info</a></td>
              <td><a class="btn btn-info btn-large" href="#">Info</a></td>
              <td><a class="btn btn-info btn-small" href="#">Info</a></td>
              <td><a class="btn btn-info disabled" href="#">Info</a></td>
              <td><a class="btn btn-info" href="#"><i class="icon-exclamation-sign icon-white"></i> Info</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-info" href="#">Info</a>
                  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
            <tr>
              <td><a class="btn btn-success" href="#">Success</a></td>
              <td><a class="btn btn-success btn-large" href="#">Success</a></td>
              <td><a class="btn btn-success btn-small" href="#">Success</a></td>
              <td><a class="btn btn-success disabled" href="#">Success</a></td>
              <td><a class="btn btn-success" href="#"><i class="icon-ok icon-white"></i> Success</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success" href="#">Success</a>
                  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
            <tr>
              <td><a class="btn btn-warning" href="#">Warning</a></td>
              <td><a class="btn btn-warning btn-large" href="#">Warning</a></td>
              <td><a class="btn btn-warning btn-small" href="#">Warning</a></td>
              <td><a class="btn btn-warning disabled" href="#">Warning</a></td>
              <td><a class="btn btn-warning" href="#"><i class="icon-warning-sign icon-white"></i> Warning</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-warning" href="#">Warning</a>
                  <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
            <tr>
              <td><a class="btn btn-danger" href="#">Danger</a></td>
              <td><a class="btn btn-danger btn-large" href="#">Danger</a></td>
              <td><a class="btn btn-danger btn-small" href="#">Danger</a></td>
              <td><a class="btn btn-danger disabled" href="#">Danger</a></td>
              <td><a class="btn btn-danger" href="#"><i class="icon-remove icon-white"></i> Danger</a></td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-danger" href="#">Danger</a>
                  <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div><!-- /btn-group -->
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="forms">

        <div class="page-header">
          <h1>Forms</h1>
        </div>

        <form class="form-horizontal" onsubmit="return false;">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="input01">Text input</label>
              <div class="controls">
                <input type="text" class="input-xlarge trololo" id="input01">
                <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="optionsCheckbox">Checkbox</label>
              <div class="controls">
                <label class="checkbox">
                  <input type="checkbox" class="trololo" id="optionsCheckbox" value="option1">
                  Option one is this and that—be sure to include why it's great
                </label>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="select01">Select list</label>
              <div class="controls">
                <select id="select01" class="trololo">
                  <option>something</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="multiSelect">Multicon-select</label>
              <div class="controls">
                <select multiple="multiple" id="multiSelect" class="trololo">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="fileInput">File input</label>
              <div class="controls">
                <input class="input-file" id="fileInput" type="file">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="textarea">Textarea</label>
              <div class="controls">
                <textarea class="input-xlarge trololo" id="textarea" rows="3"></textarea>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button class="btn">Cancel</button>
            </div>
          </fieldset>
        </form>

      </section>

      <section id="labels-badges">

        <div class="page-header">
          <h1>Labels and badges</h1>
        </div>

        <p>
          <span class="label">Default</span>
          <span class="label label-success">Success</span>
          <span class="label label-warning">Warning</span>
          <span class="label label-important">Important</span>
          <span class="label label-info">Info</span>
          <span class="label label-inverse">Inverse</span>
        </p>

        <p>
          <span class="badge badge-success">1</span>
          <span class="badge badge-success">2</span>
          <span class="badge badge-warning">3</span>
          <span class="badge badge-important">4</span>
          <span class="badge badge-info">5</span>
          <span class="badge badge-inverse">6</span>
        </p>

      </section>

    </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
  get_footer();
endif;
?>