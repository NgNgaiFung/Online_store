<div class="slider">
    <ul class="slides">
    <li>
        <img src="images/slide1.jpg">
    </li>
    <li>
        <img src="images/slide2.jpg">
    </li>
    <li>
        <img src="images/slide3.jpg">
    </li>
    </ul>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.slider');
    var instances = M.Slider.init(elems, {'height' : 700, 'indicators' : true});
  });
</script>