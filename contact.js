const scriptURL = "https://script.google.com/macros/s/AKfycbwI5GnBqtk6KB3jBVmWNtzGGMH5lUf9W6a2SfgEL5DXCLTGuL3r0nGf48fKS7pAB5RK/exec"
const form = document.forms['submit-to-google-sheet']
  form.addEventListener('submit', e => {
      e.preventDefault()
      fetch(scriptURL, {method: 'POST', body: new FormData(form)})
          .then(message => alert('Message sent successfully.'))
          .catch(error => console.error('Error.', error.message))
          document.getElementById("submit-to-google-sheet").reset();
    })