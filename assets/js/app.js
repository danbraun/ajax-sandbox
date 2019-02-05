(function() {
    
    const root = document.querySelector('#js-content');
    const searchBox = root.querySelector('.search-box');
    const button = root.querySelector('.submit-search');
    const returnText = root.querySelector('.return-text');
    
    
    const localizedData = localized_data;
    const ajaxUrl = localizedData.ajaxurl;
    
    button.onclick = (e) => {
        e.preventDefault();
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
        console.log(data)
        returnText.classList.remove('is-hidden');
        returnText.textContent = `Records Found: ${data.posts.post_count}`;
        returnText.textContent += `Posts: ${data.posts}`;
    }
})()