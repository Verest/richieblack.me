@extends('layout.main')

@section('title')
  Wikipedia Viewer
@endsection

@section('css')
  <link href="{{url(mix("/assets/css/wikipedia-viewer.css"))}}" rel="stylesheet">
@endsection

@section('content')
<div class="wiki-wrapper">
  <h2 class="h1 center">Wikipedia Viewer</h2>
  <div class="pre-content-wrapper">
    <div id="randomRow">
      <a id="randomLink" href="https://en.wikipedia.org/wiki/Special:Random" target="_blank">Random Wikipedia Article!</a>
    </div>

    <div id="searchRow">
      <form class="searchField" id="searchForm">
        <label for="searchText">Search: </label>
        <input type="text" id="searchText" placeholder="Text Here">
        <input type="submit" class="disp-none">
      </form>
    </div>
  </div>

  <div class="results">
    <div class="result" id="one">
      <a target="_blank" id="linkOne">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="two">
      <a target="_blank" id="linkTwo">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="three">
      <a target="_blank" id="linkThree">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="four">
      <a target="_blank" id="linkFour">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="five">
      <a target="_blank" id="linkFive">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="six">
      <a target="_blank" id="linkSix">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="seven">
      <a target="_blank" id="linkSeven">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="eight">
      <a target="_blank" id="linkEight">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="nine">
      <a target="_blank" id="linkNine">
        <h4></h4>
        <p></p>
      </a>
    </div>
    <div class="result" id="ten">
      <a target="_blank" id="linkTen">
        <h4></h4>
        <p></p>
      </a>
    </div>
  </div> <!--end results -->
</div>
<!--end wiki view -->
@endsection

@section('js')
{{--  <script--}}
{{--  src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
{{--  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
{{--  crossorigin="anonymous"></script>--}}

<script>
  var contentID = ["#one", "#two", "#three", "#four", "#five", "#six", "#seven", "#eight", "#nine", "#ten"];
  var linkID = ["#linkOne", "#linkTwo", "#linkThree", "#linkFour", "#linkFive", "#linkSix", "#linkSeven", "#linkEight", "#linkNine", "#linkTen"];

  function searchWiki(search) {
    console.log('insearch');
    $.ajax({
      dataType: "jsonp",
      url: "https://en.wikipedia.org/w/api.php?action=opensearch&format=json&search=" + search + "&limit=15&redirects=resolve",
      crossDomain: true,
      headers: {
        "Api-User-Agent": "www.richieblack.me"
      },
      success: function(data) {
        var count = 0;
        //clear old search content
        for (var i = 0; i < 10; i++) {
          $(contentID[i]).find("h4").empty();
          $(contentID[i]).find("p").empty();
          $(linkID[i]).removeAttr("href");
        }
        //more than 10 if some entries invalid
        for (var i = 0; i < data[1].length; i++) {
          if (count > 9) {
            break;
          }
          //get rid of disambiguation pages & no info pages
          if (/may refer to/i.test(data[2][i])||!data[2][i]) {
            continue;
          }
          //update html
          $(contentID[count]).find("h4").html(data[1][i]); //header
          $(contentID[count]).find("p").html(data[2][i]); //content
          $(linkID[count]).attr("href", data[3][i]); //link

          count++
        }
      }
    });
  }

  $(function() {
    $('#searchForm').submit(function(e) {
      $(".results").addClass("display-all");
      searchWiki($("#searchText").val());
      e.preventDefault();
      //return false;
    });
  });

</script>
@endsection
