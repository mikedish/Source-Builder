$(document).ready(function() {
    var issueForm = document.getElementById('issues')

    issueForm.addEventListener('submit', sendGithubIssue)
    
    function clearForm(form) {
      $(form).find('input, textarea').val('')
    }

    function sendGithubIssue(event) {
        var form = event.target,
        formData = { title: form['issue[title]'].value, body: form['issue[body]'].value }
        event.preventDefault()
      

        $.ajax({
            url: 'https://api.github.com/repos/mikedish/Source-Builder/issues',
            data: JSON.stringify(formData),
            type: 'POST',
            dataType: 'json',
            beforeSend: function(xhr){ xhr.setRequestHeader('Authorization', 'token c49dc335f3b447d55180fc93eb1dc536ae85f28b') },
            success: function(data) {
                $('#issues-modal').modal('hide')
                clearForm(form)
            }
        })
    }
})
