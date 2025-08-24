
<div id="loader-container">
  <div class="ring" id="loadingmsg" style="display: block;">
    Loading
    <span class="spanL"></span>
  </div>
  <div id="loadingover" style="display: block;"></div>
</div>

<script>
  function showLoading() {
    // Check if the page has already been loaded
    if (sessionStorage.getItem("pageLoaded") !== "true") {
      $("#loadingover").show();
      $("#loadingmsg").show();
    }
  }

  // Call the showLoading function when the page starts loading
  showLoading();

  // Listen for the page load event
  $(window).on("load", function () {
    // Hide the loading spinner when the page is fully loaded
    $("#loadingover").hide();
    $("#loadingmsg").hide();
    // Set a flag in sessionStorage to indicate the page has been loaded
    sessionStorage.setItem("pageLoaded", "true");
  });

  // Reset the flag when the page is unloaded (e.g., when navigating away)
  $(window).on("unload", function () {
    sessionStorage.removeItem("pageLoaded");
  });
</script>