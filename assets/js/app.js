(function() {
    
    const root = document.querySelector('#js-content');
    const heading = document.createElement('h1');
    heading.textContent = 'AJAX SANDBOX';
    root.appendChild(heading);

    const searchBox = document.createElement('input');
    root.appendChild(searchBox);

    const button = document.createElement('button');
    button.textContent = 'Submit'
    root.appendChild(button);

    const returnText = document.createElement('pre');
    root.appendChild(returnText);

    const localizedData = localized_data;
    const ajaxUrl = localizedData.ajaxurl;
    
    button.onclick = () => {
        requestAjax();
    }
    
    function requestAjax() {
        const data = {
            'action': 'respond_please',
            'search_query_text': searchBox.value
        }
        fetch(ajaxUrl, {
            credentials: 'same-origin',
            headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
            body: Object.entries(data).map(e => e.join('=')).join('&'),
            msg: 'hello',
            method: 'POST',
        })
        .then( (res) => res.json())
        .then( (data) => {
            updateDOM(data);
        })
        .catch( (error) => {
            console.log(JSON.stringify(error));
        })
    }
    function updateDOM(data) {
        returnText.textContent = `You searched: ${data.text_msg}`;
    }
})()