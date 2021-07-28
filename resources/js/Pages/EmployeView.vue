<template>
    <app-layout>
        <template #header>
            <div class="w-full flex flex-row">
                <div class="w-1/2 pt-1">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        SPPD
                    </h3>
                </div>
                <div class="w-1/2 flex flex-row-reverse">
                    <button class="flex text-sm  py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500  rounded hover:bg-gray-200" @click="getNewEmploye">New</button>
                    <pagination class="mr-4" v-if="employes" :data="employes" @pagination-change-page="getResult"></pagination>
                </div>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-3" style="min-height:80vh;">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">URUT</th>
                                <th class="px-4 py-2">NAMA</th>
                                <th class="px-4 py-2">JABATAN</th>
                                <th class="px-4 py-2">GOLONGAN</th>
                                <th class="px-4 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody v-if="employes">
                            <tr v-for="(data, index) in employes.data" :key="index">
                                <td scope="row" class="border px-4 py-2 text-center align-top">{{ index+1 }}</td>
                                <td class="border px-4 py-2"><a href="javascript:void(0)" @click="showModalToggle(1, data, index)">{{ data.fullname }}<br><span class="text-sm text-gray-500"> NIP. {{ data.employe.nip }}</span></a></td>
                                <td class="border px-4 py-2">{{ data.employe.jabatan }}</td>
                                <td class="border px-4 py-2">{{ data.employe.pangkat }}</td>
                                <td class="border px-4 py-2">{{ data.employe.status }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination class="mt-4" v-if="employes" :data="employes" @pagination-change-page="getResult"></pagination>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between pl-5 pr-5 pt-4 pb-1 align-middle border-b border-solid border-gray-300 rounded-t">
                        <h3 class="text-md font-semibold">
                            Pegawai #{{ employe.name }}
                        </h3>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-md leading-none font-semibold outline-none focus:outline-none" v-on:click="showModalToggle(0)">
                        <span class="bg-transparent text-black opacity-5 h-6 w-6 text-md block outline-none focus:outline-none">
                            ×
                        </span>
                        </button>
                    </div>
                    <!--body-->
                    <form @submit.prevent="saveEmploye">
                        <div class="relative p-6 flex-auto">
                            <div class=" max-w-xl" style="height:550px; width:800px">
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Nama (tanpa emblem)
                                        </label>
                                        <input v-model="employe.name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Nama Lengkap
                                        </label>
                                        <input v-model="employe.fullname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            NIP
                                        </label>
                                        <input v-model="employe.nip" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Jabatan
                                        </label>
                                        <input v-model="employe.jabatan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Pangkat
                                        </label>
                                        <input v-model="employe.pangkat" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Status
                                        </label>
                                        <input v-model="employe.status" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Email
                                        </label>
                                        <input v-model="employe.email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="text">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Aktif
                                        </label>
                                        <select v-model="employe.is_active" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="isUpdate==false" class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Password
                                        </label>
                                        <input v-model="employe.password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-2 px-3 mb-2 leading-tight focus:outline-none focus:bg-white" type="password">
                                    </div>
                                </div>

                                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                                    <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" v-on:click="showModalToggle(0)">
                                        Close
                                    </button>
                                    <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1" type="submit">
                                        Save Changes
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </app-layout>
</template>
<script>
    import AppLayout from './../Layouts/AppLayout'
    export default {
        props:['data'],
        components: {
                AppLayout,
        },
        data(){
            return{
                isUpdate:false,
                showModal:false,
                employes:null,
                employe_idx:null,
                employe:new Form({
                    'id'        :'',
                    'name'      : '',
                    'fullname'  : '',
                    'nip'       : '',
                    'email'     : '',
                    'jabatan'   : '',
                    'pangkat'   : '',
                    'status'    : '',
                    'password'  : '',
                    'is_active' : 1,
                }),
            }
        },
        methods:{
            getResult(page){
                let uri = '/api/employe?page=' + page;
                axios.get(uri).then(response => {
                            return response.data;
                        }).then(data => {
                            this.employes = data;
                        });
            },
            getNewEmploye(){
                this.clearForm()
                this.isUpdate = false
                this.showModal = !this.showModal
            },
            showModalToggle(status, data, index){
                if(status==1){
                    this.isUpdate          = true
                    this.employe.id        = data.id
                    this.employe.name      = data.name
                    this.employe.fullname  = data.fullname
                    this.employe.email     = data.email
                    this.employe.nip       = data.employe.nip
                    this.employe.jabatan   = data.employe.jabatan
                    this.employe.pangkat   = data.employe.pangkat
                    this.employe.status    = data.employe.status
                    this.employe.is_active    = data.employe.is_active

                    this.employe_idx = index
                    this.showModal  = !this.showModal
                }else{
                    this.clearForm()
                    this.showModal = !this.showModal
                }
            },
            clearForm(){
                this.isUpdate          = false
                this.employe.id        = ''
                this.employe.name      = ''
                this.employe.fullname  = ''
                this.employe.nip       = ''
                this.employe.email     = ''
                this.employe.jabatan   = ''
                this.employe.pangkat   = ''
                this.employe.status    = ''
                this.employe.password  = ''
            },
            saveEmploye(){
                if(this.employe.id != ''){
                    this.employe.put('/api/employe/'+ this.employe.id)
                    .then(res=>{
                        this.employes.data[this.employe_idx].name      = this.employe.name
                        this.employes.data[this.employe_idx].fullname  = this.employe.fullname
                        this.employes.data[this.employe_idx].email     = this.employe.email
                        this.employes.data[this.employe_idx].employe.nip            = this.employe.nip
                        this.employes.data[this.employe_idx].employe.jabatan        = this.employe.jabatan
                        this.employes.data[this.employe_idx].employe.pangkat        = this.employe.pangkat
                        this.employes.data[this.employe_idx].employe.status         = this.employe.status
                        this.clearForm()
                        this.showModal = !this.showModal

                        if(this.employe.is_active==0){
                            this.employes.data.splice(this.employe_idx,1)
                        }
                    })
                }else{
                    this.employe.post('/api/employe')
                    .then(res=>{
                        this.clearForm()
                        this.showModal = !this.showModal
                    })
                }
            },
            SetActive(){
                this.employe.put('/api/employe/'+ this.employe.id)
                .then(res=>{

                })
            }
        },
        mounted(){
            this.employes = this.data
        }
    }
</script>