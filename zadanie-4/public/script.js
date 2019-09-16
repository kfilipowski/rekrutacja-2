$(function() {
  loadForm('');
});

function nextStep(e) {
  e.preventDefault();
  let params = $('form').serialize();
  loadForm('&' + params);
}

function resetStep(e) {
  e.preventDefault();
  loadForm('&reset');
}

function loadForm(params) {
  let loader = $('.loader');
  loader.show();
  fetch('index.php?form' + params)
    .then(resp => resp.json())
    .then(resp => {
      let form = $(resp);
      $('form').replaceWith(form);
      form.find('[name="next"]').click(this.nextStep);
      form.find('[name="reset"]').click(this.resetStep);
      loader.hide();
    });
}
