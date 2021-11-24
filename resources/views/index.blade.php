@extends('setting::layout')
@section('content')

    <div x-data="pageData">
        <h1>Setting Management</h1>
        <br>

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true" x-text="defaultproviderName"
                    x-on:click="changeTab(defaultproviderName)"></button>
            </li>

            <template x-for="(item,index) in providerNames">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" x-bind:id="item+'-tab'" data-bs-toggle="tab" x-bind:data-bs-target="'#'+item" type="button"
                        role="tab"  aria-selected="false" x-text="item" x-on:click="changeTab(item)"></button>
                </li>
            </template>
           
          
        </ul>
        <div class="tab-content" id="myTabContent">
            <div style="margin-top:10px" class="text-end">
                {{-- todo --}}
                {{-- <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">新增</button> --}}
            </div>
          
            <div class="tab-pane fade show active">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Key</th>
                        <th scope="col">Type</th>
                        <th scope="col">Value</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item,index) in targets">
                      <tr>
                        <th scope="row" x-text="index+1"></th>
                        <td x-text="item.key"></td>
                        <td x-text="item.type"></td>

                        <template x-if="item.type=='json'">
                            <td x-text="JSON.stringify(item.value)"></td>
                        </template>
                        <template x-if="item.type!='json'">
                            <td x-text="item.value"></td>
                        </template>
                      
                        <td>
                            <a href="">編輯</a> | <a href="javascript:void(0)" x-on:click="remove(item)">刪除</a>
                        </td>
                      </tr>
                    </template>
                    </tbody>
                  </table>       
            </div>
        
        </div>
        <div class="text-center" style="margin-bottom: 10px">
               {{-- todo --}}
            {{-- <button type="button" x-on:click="saveAll() " class="btn btn-success">全部儲存</button> --}}
        </div>
        
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>





    <script>
        function pageData() {
            return {
                providerNames:@json($providerName),
                defaultproviderName:@json($defaultproviderName),
                settings:@json($settings),
                targets:[],
                changeTab(providerName){
                    this.targets = this.settings.filter(x=>x.provider_name == providerName);
                },
                saveAll(){
                    console.log(this.settings);
                },
                remove(item){
                    this.settings = this.settings
                        .filter(x=> x.provider_name != item.provider_name ||
                                x.key != item.key);
                    this.changeTab(item.provider_name);
                },
                update(item){

                },
                init() {
                    this.changeTab(this.defaultproviderName);
                }
            }
        }

      
    </script>
@endsection
