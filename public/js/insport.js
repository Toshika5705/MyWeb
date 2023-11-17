function openForm() {
    $('#formModal').modal('show');
}
async function opendelFrom(){
    $('#delfrom').modal('show');
}

async function submitForm() {
    
    // 獲取表單數值
    var memberid = $('#memberid').val();
    var createTime = $('#clientTime').val();
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var myUrl = $('#myUrl').val();
    var updateTime = $('#clientTime').val();


    if (!title || !subtitle || !myUrl) {
        // 顯示錯誤訊息或進行其他處理
        alert('以上不能為空');
        return false; // 阻止表單提交
    }

    // 使用 Fetch API 發送 POST 請求
    await fetch('/api/folio/InsPoerfolio', {
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
    
    return true; // 允許表單提交

}

async function delForm(){

    var memberid = $('#memberid').val();
    var createtime = $('#createtime').val();

    await fetch('/api/folio/DeletePoerfolio',{
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer YOUR_TOKEN_HERE',
        },
        body: JSON.stringify({
            memberid : memberid,
            createtime : createtime
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        //F5 刷新
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

