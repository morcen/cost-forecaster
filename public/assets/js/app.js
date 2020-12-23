function generateTable (data) {
  var table = document.createElement('table')

  let headers = ['Month', 'Number of studies', 'Forecasted cost']
  let tr = table.insertRow(-1)
  for (let i = 0; i < headers.length; i++) {
    let th = document.createElement('th')      // TABLE HEADER.
    th.innerHTML = headers[i]
    tr.appendChild(th)
  }

  let col = []
  for (let i = 0; i < data.length; i++) {
    for (let key in data[i]) {
      if (col.indexOf(key) === -1) {
        col.push(key)
      }
    }
  }

  for (let i = 0; i < data.length; i++) {

    tr = table.insertRow(-1)

    for (let j = 0; j < col.length; j++) {
      var tabCell = tr.insertCell(-1)
      tabCell.innerHTML = data[i][col[j]]
    }
  }

  var divContainer = document.getElementById('forecast')
  divContainer.innerHTML = ''
  divContainer.appendChild(table)
}

function renderErrors(data) {
  const id = `${data.field}-error`

  document.getElementById(id).innerHTML = data.message
}

const contactForm = document.getElementById('forecaster')

contactForm.addEventListener('submit', function (event) {

  event.preventDefault()

  let request = new XMLHttpRequest()
  let url = '/compute'
  request.open('POST', url, true)
  request.setRequestHeader('Content-Type', 'application/json')
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      let jsonData = JSON.parse(request.response)
      if (request.status === 200) {
        generateTable(jsonData)
      } else {
        if (jsonData.errors) {
          jsonData.errors.forEach(renderErrors)
        }
      }
    }
  }
  const studyCount = document.getElementById('studyCount').value
  const studyGrowth = document.getElementById('studyGrowth').value
  const months = document.getElementById('months').value

  const data = JSON.stringify({ 'studyCount': studyCount, 'studyGrowth': studyGrowth, 'months': months })

  request.send(data)

})
