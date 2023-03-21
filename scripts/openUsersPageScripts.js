fetchUser()
function fetchUser() {
    let action = "Load";
    $.ajax({
        url: '/users/list',
        method: "POST",
        dataType: "json",
        data: {action: action},
        success: function (data) {
            data.user.forEach(element => {
                $('#usersList').append(`<tr id="user${element.id}">
                                                        <td class="align-middle text-center">
                                                            <div
                                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                <input type="checkbox" class="custom-control-input items"
                                                                       data-id="users" id="${element.id}">
                                                                <label class="custom-control-label" for="${element.id}"></label>
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap align-middle userName text-center">${element.firstname} ${element.lastname}</td>
                                                        <td class="text-nowrap align-middle userRole text-center">
                                                            <span>${element.role === '1' ? 'User' : 'Admin'}</span>
                                                        </td>
                                                        <td class="text-center align-middle text-center">
                                                              ${element.status === 1 ?
                    '<i class="fa fa-circle active-circle userStatus"></i>' :
                    '<i class="fa fa-circle circle greyCircle userStatus"></i>'}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group align-top">
                                                                <button class="btn btn-sm btn-outline-secondary badge edit"
                                                                        type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#user-form-modal"
                                                                        value="${element.id}">Редагувати
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary badge fa fa-trash delete"
                                                                        data-toggle="modal"
                                                                        data-target="#user-confirm"
                                                                        type="button" value="${element.id}">
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>`);
            })
        }
    })
}
