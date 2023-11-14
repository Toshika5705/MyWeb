function openForm() {

    $('#formModal').modal('show');
}

function submitForm() {
    
    // 獲取表單數值
    var memberid = $('#memberid').val();
    var createTime = $('#clientTime').val();
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var myUrl = $('#myUrl').val();
    var updateTime = $('#clientTime').val();

    // 使用 Fetch API 發送 POST 請求
    fetch('/api/folio/InsPoerfolio', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer YOUR_TOKEN_HERE',
        },
        body: JSON.stringify({
            MemberId : memberid,
            CreateTime: createTime,
            Title: title,
            Subtitle: subtitle,
            MyUrl: myUrl,
            UpdateTime: updateTime,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        $('#formModal').modal('hide'); // 隱藏表單彈窗
    })
    .catch(error => {
        console.error('Error:', error);
        // 處理錯誤，例如顯示錯誤消息
    });
}

