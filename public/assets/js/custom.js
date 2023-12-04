document.addEventListener('DOMContentLoaded', function() {
    var postLinks = document.querySelectorAll('.block.font-medium.text-base.mt-5');
    postLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        var postId = this.getAttribute('data-post-id');
        var contentContainer = document.getElementById('content-' + postId);
        contentContainer.classList.add('expanded-content');
      });
    });
  });
