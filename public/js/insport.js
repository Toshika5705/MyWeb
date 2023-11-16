function openForm() {
    $('#formModal').modal('show');
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

async function getFormList(){

    var memberid = $('#memberid').val();
    var pagenumber = $('#pagenumber').val();

    await fetch('/api/folio/GetPoerfolio',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer YOUR_TOKEN_HERE',
        },
        body: JSON.stringify({
            MemberId : memberid,
            PageSize : 2,
            PageNumber : 1,
        }),
    })
    .then(response => response.json())
    .then(data => {
        // 動態生成卡片
        var cardContainer = document.getElementById('cardContainer');
        cardContainer.innerHTML = '';

        data.forEach(item => {
            var card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">${item.Title}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">${item.Subtitle}</h6>
                    <p class="card-text">${item.MyUrl}</p>
                </div>
            `;
            cardContainer.appendChild(card);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

async function displayPortList(){
    const getlist = await getFormList();
    console.log(getlist);
}

