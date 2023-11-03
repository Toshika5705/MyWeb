// 獲取當前時間
function getCurrentTime() {
    const options = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        timeZoneName: 'short',
    };
    return new Date().toLocaleString('en-US', options).replace(/\//g, '-');
}

// 在某個元素中顯示時間
function displayTime() {
    //value 給後端寫的 textContent是前端轉變使用的
    document.getElementById('clientTime').value = getCurrentTime();
    //document.getElementById('Logintime').textContent = getCurrentTime();
}

// 將時間傳遞給 Laravel 後端
function sendTimeToBackend() {
    fetch('/api/area/saveTime', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            time: getCurrentTime(),
        }),
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

// 在這裡執行函數
sendTimeToBackend();
displayTime();