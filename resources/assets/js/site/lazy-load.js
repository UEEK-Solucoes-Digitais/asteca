document.addEventListener("DOMContentLoaded", function() {
    var lazyloadImages;    
    var lazyloadBackgrounds;
  
      if ("IntersectionObserver" in window) {
  
          lazyloadBackgrounds = document.querySelectorAll(".background-lazy");
          var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                var image = entry.target;
                image.classList.remove("background-lazy");
                imageObserver.unobserve(image);
              }
            });
          });
  
          lazyloadBackgrounds.forEach(function(image) {
            imageObserver.observe(image);
          });
  
          lazyloadImages = document.querySelectorAll(".lazy");
          var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                var image = entry.target;
                image.src = image.dataset.src;
                image.classList.remove("lazy");
                imageObserver.unobserve(image);
              }
            });
          });
  
          lazyloadImages.forEach(function(image) {
            imageObserver.observe(image);
          });
  
      } else {  
          var lazyloadThrottleTimeout;
          lazyloadImages = document.querySelectorAll(".lazy");
      
          function lazyload () {
            if(lazyloadThrottleTimeout) {
              clearTimeout(lazyloadThrottleTimeout);
            }    
  
            lazyloadThrottleTimeout = setTimeout(function() {
              var scrollTop = window.pageYOffset;
              lazyloadImages.forEach(function(img) {
                  if(img.offsetTop < (window.innerHeight + scrollTop)) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                  }
              });
              if(lazyloadImages.length == 0) { 
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
              }
            }, 20);
          }
  
          var lazyloadThrottleTimeoutBackgrounds;
          lazyloadBackgrounds = document.querySelectorAll(".background-lazy");
          
          function lazyloadBackgrounds () {
            if(lazyloadThrottleTimeoutBackgrounds) {
              clearTimeout(lazyloadThrottleTimeoutBackgrounds);
            }    
  
            lazyloadThrottleTimeoutBackgrounds = setTimeout(function() {
              var scrollTop = window.pageYOffset;
              lazyloadBackgrounds.forEach(function(img) {
                  if(img.offsetTop < (window.innerHeight + scrollTop)) {
                    img.src = img.dataset.src;
                    img.classList.remove('background-lazy');
                  }
              });
              if(lazyloadBackgrounds.length == 0) { 
                document.removeEventListener("scroll", lazyload, lazyloadBackgrounds);
                window.removeEventListener("resize", lazyload, lazyloadBackgrounds);
                window.removeEventListener("orientationChange", lazyload, lazyloadBackgrounds);
              }
            }, 20);
          }
  
          document.addEventListener("scroll", ()=> {lazyload, lazyloadBackgrounds});
          window.addEventListener("resize", ()=> {lazyload, lazyloadBackgrounds});
          window.addEventListener("orientationChange", ()=> {lazyload, lazyloadBackgrounds});
      }
  })