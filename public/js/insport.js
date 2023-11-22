function openForm(action) {
    // 設定表單的動作
    document.getElementById('formAction').value = action;

    // 根據動作設定表單標題 data-title 再塞入id裡
    var formTitle = (action === 'A') ? document.querySelector('[data-title="A"]').textContent : document.querySelector('[data-title="U"]').textContent;
    document.getElementById('formTitle').innerHTML = formTitle;

    //取card上 的 資料
    var title = $(event.currentTarget).data('jstitle');
    var subtitle = $(event.currentTarget).data('jssubtitle');
    var myurl = $(event.currentTarget).data('jsmyurl');
    var logtime = $(event.currentTarget).data('jslogtime');

    //塞入清單裡的name名稱
    var JsTitle = document.querySelector('input[name="JsTitle"]');
    var JsSubtitle = document.querySelector('input[name="JsSubtitle"]');
    var JsMyUrl = document.querySelector('input[name="JsMyUrl"]');
    var Jsoldtime = document.querySelector('input[name="Jsoldtime"]');
    JsTitle.value = title;
    JsSubtitle.value = subtitle;
    JsMyUrl.value = myurl;
    Jsoldtime.value = logtime;

    $('#formModal').modal('show');
}
async function opendelFrom(){
    $('#delfrom').modal('show');
}

async function submitForm() {

    var action = document.getElementById('formAction').value;

    // 獲取表單數值
    var memberid = $('#memberid').val();
    var createTime = $('#clientTime').val();
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var myUrl = $('#myUrl').val();
    var updateTime = $('#clientTime').val();
    var old_createtime = $('#oldcreatetime').val();

    
    if (!title || !subtitle || !myUrl) {
        // 顯示錯誤訊息或進行其他處理
        alert('以上不能為空');
        return false; // 阻止表單提交
    }


    // 根據不同的動作執行不同的 API 功能
    if (action === 'A') {

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

    } else if (action === 'U') {

        await fetch('/api/folio/UpdatePortfolio',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer YOUR_TOKEN_HERE',
            },
            body: JSON.stringify({
                MemberId : memberid,
                CreateTime: old_createtime,
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
        console.log('Success:', data);
        $('#delfrom').modal('hide'); // 隱藏表單彈窗
        //F5 刷新
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

