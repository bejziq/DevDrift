var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.replace("index.html");
    }
    $("#login-form").validate({
      submitHandler: function (form) {
        var entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });
    if ($("#register-link").length === 0 && $("#login-form").length) {
      $("#login-form").append('<a id="register-link" href="register.html" class="btn btn-link">Register</a>');
    }
  },

   registerInit: function () {
  $("#register-form").validate({
    rules: {
      name: { required: true },
      surname: { required: true },
      email: { required: true, email: true },
      password: { required: true, minlength: 6 }
    },
    submitHandler: function (form) {
      var entity = Object.fromEntries(new FormData(form).entries());
      UserService.register(entity);
    }
  });
},

register: function (entity) {
  $.ajax({
    url: Constants.PROJECT_BASE_URL + "auth/register",
    type: "POST",
    data: JSON.stringify(entity),
    contentType: "application/json",
    dataType: "json",
    success: function (result) {
      toastr.success("Registration successful! Please login.");
      setTimeout(function () {
        window.location.replace("login.html");
      }, 1500);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      toastr.error(XMLHttpRequest?.responseText ? XMLHttpRequest.responseText : 'Error');
    }
  });
},


  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        console.log(result);
        localStorage.setItem("user_token", result.data.token);
        window.location.replace("index.html");
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("login.html");
  },


  generateMenuItems: function(){
    const token = localStorage.getItem("user_token");
    let user;
    try {
      user = Utils.parseJwt(token).user;
    } catch (e) {
      window.location.replace("login.html");
      return;
    }

    if (user && user.roles){
      let nav = "";
      let main = "";
      switch(user.roles) {
        case Constants.USER_ROLE:
          nav = `
  <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
  <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
  <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#hero" id="navbarDropdownContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Content
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownContent">
      <li><a class="dropdown-item" href="#starter-page">News</a></li>
      <li class="dropdown-submenu">
        <a class="dropdown-item dropdown-toggle" href="#learn" id="navbarDropdownLearn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Learn
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownLearn">
          <li><a class="dropdown-item" href="https://www.w3schools.com/python/">Python</a></li>
          <li><a class="dropdown-item" href="https://www.w3schools.com/js/">JavaScript</a></li>
          <li><a class="dropdown-item" href="https://www.w3schools.com/cpp/">C++</a></li>
          <li><a class="dropdown-item" href="https://www.w3schools.com/java/">Java</a></li>
          <li><a class="dropdown-item" href="https://www.w3schools.com/MySQL/default.asp">MySQL</a></li>
        </ul>
      </li>
      <li><a class="dropdown-item" href="#career">Career</a></li>
      <li><a class="dropdown-item" href="#oglasi">Jobs</a></li>
      <li><a class="dropdown-item" href="#companies">Companies</a></li>
    </ul>
  </li>
  <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
  <li class="nav-item">
    <button class="btn btn-primary ms-2" onclick="UserService.logout()">Logout</button>
  </li>
`;
            $("#tabs").html(nav);

      main = '<section id="hero" data-load="hero.html"></section>'+
              '<section id="about" data-load="about.html"></section>'+
              '<section id="features" data-load="features.html"></section>'+
              '<section id="starter-page" data-load="starter-page.html"></section>'+
              '<section id="learn" data-load="learn.html"></section>'+
              '<section id="career" data-load="career.html"></section>'+
              '<section id="contact" data-load="contact.html"></section>'+
              '<section id="register" data-load="register.html"></section>'+
              '<section id="faq" data-load="faq.html"></section>'+
              '<section id="oglasi" data-load="oglasi.html"></section>'+
              '<section id="blog-detail" data-load="blog-detail.html"></section>'+
              '<section id="blog-detail2" data-load="blog-detail2.html"></section>'+
              '<section id="blog-detail3" data-load="blog-detail3.html"></section>'+
              '<section id="01" data-load="01.html"></section>'+
              '<section id="klika" data-load="klika.html"></section>'+
              '<section id="02" data-load="02.html"></section>'+
              '<section id="more_screens" data-load="more_screens.html"></section>'+
              '<section id="companies" data-load="companies.html"></section>';
          $("#tabs").html(nav);
          $("#spapp").html(main);
          break;
        case Constants.ADMIN_ROLE:
          nav = `
<li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#about">About</a></li>
<li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#hero" id="navbarDropdownContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Content
  </a>
  <ul class="dropdown-menu" aria-labelledby="navbarDropdownContent">
    <li><a class="dropdown-item" href="#starter-page">News</a></li>
    <li class="dropdown-submenu">
      <a class="dropdown-item dropdown-toggle" href="#learn" id="navbarDropdownLearn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Learn
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdownLearn">
        <li><a class="dropdown-item" href="https://www.w3schools.com/python/">Python</a></li>
        <li><a class="dropdown-item" href="https://www.w3schools.com/js/">JavaScript</a></li>
        <li><a class="dropdown-item" href="https://www.w3schools.com/cpp/">C++</a></li>
        <li><a class="dropdown-item" href="https://www.w3schools.com/java/">Java</a></li>
        <li><a class="dropdown-item" href="https://www.w3schools.com/MySQL/default.asp">MySQL</a></li>
      </ul>
    </li>
    <li><a class="dropdown-item" href="#career">Career</a></li>
    <li><a class="dropdown-item" href="#oglasi">Jobs</a></li>
    <li><a class="dropdown-item" href="#companies">Companies</a></li>
  </ul>
</li>
<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
<li class="nav-item"><a class="nav-link" href="#admin-log-details">Log Details</a></li>
<li class="nav-item">
  <button class="btn btn-primary ms-2" onclick="UserService.logout()">Logout</button>
</li>
`;
$("#tabs").html(nav);

          main =
              '<section id="hero" data-load="hero.html"></section>'+
    '<section id="about" data-load="about.html"></section>'+
    '<section id="features" data-load="features.html"></section>'+
    '<section id="starter-page" data-load="starter-page.html"></section>'+
    '<section id="learn" data-load="learn.html"></section>'+
    '<section id="career" data-load="career.html"></section>'+
    '<section id="contact" data-load="contact.html"></section>'+
    '<section id="register" data-load="register.html"></section>'+
    '<section id="faq" data-load="faq.html"></section>'+
    '<section id="oglasi" data-load="oglasi.html"></section>'+
    '<section id="blog-detail" data-load="blog-detail.html"></section>'+
    '<section id="blog-detail2" data-load="blog-detail2.html"></section>'+
    '<section id="blog-detail3" data-load="blog-detail3.html"></section>'+
    '<section id="01" data-load="01.html"></section>'+
    '<section id="klika" data-load="klika.html"></section>'+
    '<section id="02" data-load="02.html"></section>'+
    '<section id="more_screens" data-load="more_screens.html"></section>'+
    '<section id="companies" data-load="companies.html"></section>'+
    '<section id="admin-log-details" data-load="admin-log-details.html"></section>';
              $("#spapp").html(main);
          break;
        default:
          $("#tabs").html(nav);
          $("#spapp").html(main);
      }
    } else {
        window.location.replace("login.html");
    }
  }
};