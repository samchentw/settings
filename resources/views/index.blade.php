@extends('setting::layout')
@section('content')

    <div x-data="pageData" style="margin-top:10px">
        <h3>Setting Management(開發者頁面)</h3>
        <br>

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true" x-text="defaultproviderName"
                    x-on:click="changeTab(defaultproviderName)"></button>
            </li>

            <template x-for="(item,index) in providerNames">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" x-bind:id="item+'-tab'" data-bs-toggle="tab"
                        x-bind:data-bs-target="'#'+item" type="button" role="tab" aria-selected="false" x-text="item"
                        x-on:click="changeTab(item)"></button>
                </li>
            </template>


        </ul>
        <div class="tab-content" id="myTabContent">
            <div style="margin-top:10px" class="text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    x-on:click="createOpen()">新增</button>
            </div>

            <div class="tab-pane fade show active">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DisplayName</th>
                            <th scope="col">Key</th>
                            <th scope="col">Type</th>
                            <th scope="col">Value</th>
                            <th scope="col">Sort</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item,index) in targets">
                            <tr>
                                <th scope="row" x-text="index+1"></th>
                                <td x-text="item.display_name"></td>
                                <td x-text="item.key"></td>
                                <td x-text="item.type"></td>

                                <template x-if="item.type=='json'">
                                    <td x-text="JSON.stringify(item.value)"></td>
                                </template>
                                <template x-if="item.type!='json'">
                                    <td x-text="item.value"></td>
                                </template>

                                <td x-text="item.sort"></td>
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        x-on:click="editOpen(item)">編輯</a> | <a href="javascript:void(0)"
                                        x-on:click="remove(item)">刪除</a>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="text-center" style="margin-bottom: 10px">
            <button type="button" x-on:click="saveAll() " class="btn btn-success">全部儲存</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <template x-if="isCreate">
                                <span>建立設定</span>
                            </template>

                            <template x-if="!isCreate">
                                <span>修改設定</span>
                            </template>

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="mb-3">
                                <label class="form-label">Display Name</label>
                                <input x-model="form.display_name" type="text" class="form-control"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Key</label>
                                <input x-model="form.key" type="text" class="form-control" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select x-model="form.type" x-on:change="selectChange($event)" class="form-select"
                                    aria-label="Default select example">
                                    <option selected value="string">string</option>
                                    <option value="password">password</option>
                                    <option value="text">text</option>

                                    <option value="number">number</option>
                                    <option value="boolean">boolean</option>
                                    <option value="html">html</option>
                                    <option value="date">date</option>
                                    <option value="date_time">date_time</option>
                                    <option value="json">json</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Value</label>
                                <template x-if="form.type == 'json'">
                                    <span style="color: red">注意！格式需為陣列。</span>
                                </template>

                                <template
                                    x-if="form.type=='string' || form.type=='date' || form.type=='date_time' || form.type=='password'">
                                    <input x-model="form.value" type="text" class="form-control">
                                </template>

                                <template x-if="form.type=='html'  || form.type=='text'  || form.type=='json'">
                                    <textarea class="form-control" x-model="form.value" rows="3"></textarea>
                                </template>

                                <template x-if="form.type=='number'">
                                    <input x-model.number="form.value" type="number" class="form-control">
                                </template>

                                <template x-if="form.type=='boolean'">
                                    <div>
                                        <input x-model="form.value" type="checkbox" class="form-check-input"
                                            id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">True Or False</label>
                                        <div> 目前值為：<span x-text="form.value"></span></div>
                                    </div>
                                </template>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sort</label>
                                <input x-model="form.sort" type="number" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>

                        <template x-if="isCreate">
                            <button type="button" class="btn btn-primary" x-on:click="create()">建立</button>
                        </template>

                        <template x-if="!isCreate">
                            <button type="button" class="btn btn-primary" x-on:click="update()">修改</button>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function pageData() {
            return {
                apiPath: '/api/setting/reset-settings-json',
                form: {},
                isCreate: false,
                providerNames: @json($providerName),
                defaultproviderName: @json($defaultproviderName),
                settings: @json($settings),
                targets: [],
                currentSelectProviderName: '',
                resetForm() {
                    this.form = {
                        display_name: '',
                        type: 'string',
                        key: '',
                        sort: 0,
                        value: null,
                        provider_key: 0,
                        provider_name: '',
                    };
                },
                changeTab(providerName) {
                    this.currentSelectProviderName = providerName;
                    this.targets = this.settings.filter(x => x.provider_name == providerName);
                },
                saveAll() {
                    let result = JSON.stringify(this.settings);
                    let data = {
                        input: result
                    }
                    fetch(this.apiPath, {
                            method: 'PUT',
                            body: JSON.stringify(data), // data can be `string` or {object}!
                            headers: new Headers({
                                'Content-Type': 'application/json'
                            })
                        })
                        .catch(error => {
                            alert("哇！失敗QQ")
                            console.error('Error:', error)
                        })
                        .then(response => {
                            alert("修改成功！");
                            location.reload();
                        });

                },
                remove(item) {
                    this.settings = this.settings
                        .filter(x => x.provider_name != item.provider_name ||
                            x.key != item.key);
                    this.changeTab(item.provider_name);
                },
                validate(input) {
                    if (!input.key) throw '';
                    if (!input.display_name) throw '';
                },
                create() {
                    try {
                        this.validate(this.form)
                    } catch (e) {
                        alert("格式錯誤！ 不能有空值。");
                        return;
                    }

                    if (this.form.type == 'json') {
                        try {
                            this.form.value = Object.assign([], JSON.parse(this.form.value));
                            if (!Array.isArray(this.form.value)) throw '需為陣列！';
                        } catch (e) {
                            alert("格式錯誤！需為陣列格式！");
                            console.log(e)
                            return;
                        }
                    }
                    this.form.provider_name = this.currentSelectProviderName;
                    this.settings.push(this.form);
                    this.changeTab(this.form.provider_name);
                    this.resetForm();
                    this.closeModal();
                },
                update() {
                    try {
                        this.validate(this.form)
                    } catch (e) {
                        alert("格式錯誤！ 不能有空值。");
                        return;
                    }
                    let item = Object.assign({}, this.form);
                    if (item.type == 'json') {
                        try {
                            item.value = Object.assign([], JSON.parse(item.value));
                            if (!Array.isArray(item.value)) throw '需為陣列！';
                        } catch (e) {
                            alert("格式錯誤！需為陣列格式！");
                            console.log(e)
                            return;
                        }
                    }
                    this.remove(item);
                    item.provider_name = this.currentSelectProviderName;

                    this.settings.push(item);
                    this.changeTab(item.provider_name);
                    this.resetForm();
                    this.closeModal();
                },
                closeModal() {
                    const truck_modal = document.querySelector('#exampleModal');
                    const modal = bootstrap.Modal.getInstance(truck_modal, {
                        backdrop: 'static'
                    });
                    modal.hide();
                },
                createOpen() {
                    this.resetForm();
                    this.isCreate = true
                },
                editOpen(item) {
                    this.isCreate = false;
                    this.form = Object.assign({}, item);
                    if (item.type == 'json') {
                        this.form.value = JSON.stringify(this.form.value, null, 2);
                    }
                },
                selectChange(e) {
                    let targetValue = e.target.value;
                    switch (targetValue) {
                        case 'boolean':
                            this.form.value = false;
                            break;
                        case 'number':
                            this.form.value = 0;
                            break;
                        case 'json':
                            this.form.value = '[]';
                            break;
                        case 'date':
                            this.form.value = '2021-03-30';
                            break;
                        case 'date_time':
                            this.form.value = '2021-12-15 13:45:30';
                            break;
                        default:
                            this.form.value = "";
                            break;
                    }
                },
                init() {
                    this.resetForm();
                    this.changeTab(this.defaultproviderName);
                }
            }
        }
    </script>
@endsection
