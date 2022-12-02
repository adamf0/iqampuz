@extends('components.index')
@section('content')
<?php 
use Illuminate\Support\Facades\DB;
?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap');

  *,
  :after,
  :before {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
  }

  ul {
    list-style: none;
  }

  #tabs {
    display: flex;
    flex-direction: column;
  }

  #tabs blockquote {
    padding: 0 0.85rem;
    border-left: 0.2em solid #6c7d8d;
    margin: 0.5rem 0 1rem;
    color: #6c7d8d;
  }

  #tabs>[role="tablist"] {
    display: flex;
    background-color: #eeeeee;
    border-bottom: solid 0.125rem #e5e5e5;
  }

  #tabs>[role="tablist"]>[role="tab"] {
    display: flex;
    align-items: center;
    margin: 0 0 -0.125rem;
    border-right: solid 1px #d8d8d8;
    border-left: solid 1px #f9f9f9;
    border-bottom: solid 0.125rem transparent;
    padding: 0.5rem 1.5rem;
    height: 3rem;
  }

  #tabs>[role="tablist"]>[role="tab"]:is([aria-selected="true"]) {
    border-bottom: solid 0.125rem #58acdc;
    cursor: not-allowed;
  }

  #tabs>[role="tablist"]>[role="tab"]:hover:is([aria-selected="false"]) {
    cursor: pointer;
    border-bottom: solid 0.125rem #98c6e0;
  }

  #tabs>[role="tabpanel"] {
    border-bottom: solid 1px transparent;
    padding: 0.5rem 1rem;
    background-color: #eff0f3;
    color: #2c2c2c;
  }

  #tabs>[role="tabpanel"]> :where(h1, blockquote, p) {
    min-width: 20rem;
    max-width: 50rem;
  }

  #tabs>[role="tabpanel"]:not([hidden]) {
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 3rem);
  }

  #tabs>[role="tabpanel"]>h1 {
    padding: 1rem 0 0 0;
    font-size: 1.5rem;
  }

  #tabs>[role="tabpanel"]>p+ :where(h2, h3, h4) {
    margin-top: 0.75rem;
  }

  #tabs>[role="tabpanel"]>h2 {
    font-size: 1.25rem;
  }

  #tabs>[role="tabpanel"]> :where(h1, h2, h3, p)+p {
    padding: 0.5rem 0;
  }

  aside {
    position: absolute;
    right: 3rem;
    top: 5rem;
  }

  aside>a>img {
    box-shadow: 0 0 13px rgba(0, 0, 0, 0.2);
    border-radius: 1rem;
  }

  #panel-developers>p+ :where(h2, h3, h4) {
    margin-top: 0.75rem;
  }

  #panel-developers>ul {
    margin: 0.5rem 2rem;
  }

  #panel-developers>ul>li {
    list-style-type: '👉';
    padding-inline-start: 1ch;
  }

  #panel-developers>ul>li+li {
    margin: 0.5rem 0;
  }
</style>

<br>
<article id="tabs">
  <ul role="tablist" aria-label="Free HTML Tabs">
    <li role="tab" aria-selected="true" aria-controls="panel-home" id="tab-home" tabindex="0">
      Hak Kampus
    </li>
    <li role="tab" aria-selected="false" aria-controls="panel-developers" id="tab-developers" tabindex="-1">
      Hak Panel
    </li>
    <li role="tab" aria-selected="false" aria-controls="panel-information" id="tab-information" tabindex="-1">
      Hak Menu
    </li>
  </ul>
  <section id="panel-home" role="tabpanel" tabindex="0" aria-labelledby="tab-home">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>

            <th scope="col">Kampus</th>
            <th scope="col">Panel</th>


          </tr>
        </thead>
        <tbody>
          @foreach ($hak_kampus as $k)
          <tr>
            <td>{{ $k->nama_kampus }}</td>
            <td>{{ $k->nama_panel }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
  <section id="panel-developers" role="tabpanel" tabindex="0" aria-labelledby="tab-developers" hidden>
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">Panel</th>
          <th scope="col" colspan="3">Role</th>
        </tr>
      </thead>
      <tbody>

      <?php 
            error_reporting(0);
            $hak_akses = [];
             $hak = DB::table('hak_akses_panel')
            //  ->where('id_auth',$id_auth)
            //  ->where('id_panel',$k->id_panel)
             ->orderBy('id_role','DESC')
             ->get();


             foreach($hak as $s){
                $hak_akses[$s->id_panel][$s->id_auth][] = $s->id_role;
             }

          

           
          ?>

        @foreach ($hak_kampus as $k)
        <tr>

          <td>{{ $k->nama_panel }}{{ $k->id_panel }}</td>

          <td><?php 
            $hak_aksess =  $hak_akses[$k->id_panel][$id_auth];

            // echo "<pre>";
            // print_r($hak_aksess);


                if($hak_aksess[0]){
                  $hak_admin = $hak_aksess[0];
                  $hak_superadmin = $hak_aksess[1];

                    if($hak_superadmin==1){
                      $hak_superadmins = 'checked';
                    }elseif($hak_admin==2){
                      $hak_admins = 'checked';
                    }
                }else{
                  $hak_superadmins = "";
                  $hak_admins = "";
                }

                 

              
          ?></td>
         

          <td><input type="checkbox" <?php echo $hak_admins;?>  id="vehicle1" name="vehicle1" value="2">
            <label for="vehicle1"> Admin </label>
          </td>
          <td><input type="checkbox" <?php echo $hak_superadmins;?>  id="vehicle1" name="vehicle1" value="1">
            <label for="vehicle1">Super Admin </label>
          </td>

        </tr>
        @endforeach



      </tbody>
    </table>
  </section>
  <section id="panel-information" role="tabpanel" tabindex="0" aria-labelledby="tab-information" hidden>
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">Panel</th>
          <th scope="col">Nama menu</th>
          <th>To Menu </th>


        </tr>
      </thead>
      <tbody>

        @foreach ($hak_menu as $k)
        <tr>

          <td>{{ $k->nama_panel }}</td>
          <td>{{ $k->nama_menu }}</td>
          <td>{{ $k->to_menu }}</td>






        </tr>
        @endforeach



      </tbody>
    </table>
  </section>
</article>


<script>
  window.addEventListener("DOMContentLoaded", () => {

    const tabs = document.querySelectorAll('[role="tab"]');
    const tabList = document.querySelector('[role="tablist"]');

    // Add a click event handler to each tab
    tabs.forEach((tab) => {
      tab.addEventListener("click", changeTabs);
    });

    // Enable arrow navigation between tabs in the tab list
    let tabFocus = 0;

    tabList.addEventListener("keydown", (e) => {

      // Move right
      if (e.keyCode === 39 || e.keyCode === 37) {
        tabs[tabFocus].setAttribute("tabindex", -1);

        if (e.keyCode === 39) {
          tabFocus++;

          // If we're at the end, go to the start
          if (tabFocus >= tabs.length) {
            tabFocus = 0;
          }
          // Move left
        } else if (e.keyCode === 37) {
          tabFocus--;

          // If we're at the start, move to the end
          if (tabFocus < 0) {
            tabFocus = tabs.length - 1;
          }
        }

        tabs[tabFocus].setAttribute("tabindex", 0);
        tabs[tabFocus].focus();
      }
    });
  });

  function changeTabs(event) {
    const target = event.target;
    const parent = target.parentNode;
    const grandparent = parent.parentNode;

    // Remove all current selected tabs
    parent.querySelectorAll('[aria-selected="true"]').forEach((node) => node.setAttribute("aria-selected", false));

    // Set this tab as selected
    target.setAttribute("aria-selected", true);

    // Hide all tab panels
    grandparent.querySelectorAll('[role="tabpanel"]').forEach((node) => node.setAttribute("hidden", true));

    // Show the selected panel
    grandparent.parentNode.querySelector(`#${target.getAttribute("aria-controls")}`).removeAttribute("hidden");
  }
</script>

@endsection