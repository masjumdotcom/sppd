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
               <button
                  class="
                     flex
                     text-sm
                     py-2
                     px-3
                     leading-tight
                     bg-white
                     border border-gray-300
                     text-blue-500
                     rounded
                     hover:bg-gray-200
                  "
                  @click="addNewSPPD"
               >
                  New
               </button>
               <!-- <div class="mr-3">
                        <ul class="flex pl-0 list-none rounded">
                            <li class="relative text-sm block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500 border-r-0 ml-0 rounded-l hover:bg-gray-200"><a class="page-link" href="#">Previous</a></li>
                            <li class="relative text-sm block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500 border-r-0 hover:bg-gray-200"><a class="page-link" href="#">1</a></li>
                            <li class="relative text-sm block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500 border-r-0 hover:bg-gray-200"><a class="page-link" href="#">2</a></li>
                            <li class="relative text-sm block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500 border-r-0 hover:bg-gray-200"><a class="page-link" href="#">3</a></li>
                            <li class="relative text-sm block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-500 rounded-r hover:bg-gray-200"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div> -->
               <pagination
                  class="mr-4"
                  v-if="letters"
                  :data="letters"
                  @pagination-change-page="getResult"
               ></pagination>
            </div>
         </div>
      </template>
      <div class="py-6">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden p-3">
               <table class="table-auto w-full">
                  <thead class="bg-white">
                     <tr>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           URUT
                        </th>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           TANGGAL
                        </th>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           NOMOR
                        </th>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           ACARA
                        </th>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           PESERTA
                        </th>
                        <th
                           class="
                              border
                              px-4
                              py-2
                              font-semibold
                              text-xs text-gray-600
                           "
                        >
                           OUTPUT
                        </th>
                     </tr>
                  </thead>
                  <tbody v-if="letters">
                     <tr v-for="(data, index) in letters.data" :key="index">
                        <td
                           scope="row"
                           class="border px-4 py-2 text-center align-top"
                        >
                           {{ index + 1 }}
                        </td>
                        <td class="border px-4 py-2 align-top text-center">
                           <a href="javascript:void(0)">{{
                              data.date_issue | fDateD2M3Y2
                           }}</a>
                        </td>
                        <td
                           class="
                              border
                              px-4
                              py-2
                              w-1/5
                              auto-rows-max
                              align-top
                           "
                        >
                           <a
                              href="javascript:void(0)"
                              style="transition: all 0.15s ease"
                              v-on:click="toggleModal(data, index)"
                              ><div class="text-right">{{ data.nomor }}</div>
                              <div class="text-sm text-gray-500 text-right">
                                 {{ data.date_start | fDateD2M3 }}
                                 <span class="text-xs">s/d</span>
                                 {{ data.date_end | fDateD2M3 }}
                              </div></a
                           >
                        </td>
                        <td class="border px-4 py-2 w-1/3">
                           <a
                              href="javascript:void(0)"
                              v-on:click="toggleModal(data, index)"
                              >{{ data.acara }}
                              <div class="text-sm text-gray-500">
                                 {{ data.place_name }}
                              </div>
                              <div class="text-sm text-gray-500">
                                 {{ data.to }}
                              </div></a
                           >
                        </td>
                        <td class="border px-4 py-2 text-center align-top">
                           <div class="text-right">
                              <a
                                 href="javascript:void(0)"
                                 v-on:click="showParticipants(data, index)"
                              >
                                 <div v-if="data.participants.length > 0">
                                    {{ data.participants.length }}
                                    <span class="text-sm text-gray-500"
                                       >org</span
                                    >
                                 </div>
                                 <span class="text-sm" v-else>
                                    Tambahkan<br />Peserta
                                 </span>
                              </a>
                           </div>
                        </td>
                        <td class="border px-4 py-2 text-center align-top">
                           <button
                              class="
                                 bg-transparent
                                 hover:bg-blue-500
                                 text-blue-700
                                 font-semibold
                                 hover:text-white
                                 text-xs
                                 py-1
                                 px-2
                                 border border-blue-500
                                 hover:border-transparent
                                 rounded
                                 mr-1
                                 mb-1
                              "
                              @click="printSPPD(data.num_validate)"
                           >
                              Print Form
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <pagination
                  class="mt-4"
                  v-if="letters"
                  :data="letters"
                  @pagination-change-page="getResult"
               ></pagination>
            </div>
         </div>
      </div>
      <div
         v-if="showModal"
         class="
            overflow-x-hidden overflow-y-auto
            fixed
            inset-0
            z-50
            outline-none
            focus:outline-none
            justify-center
            items-center
            flex
         "
      >
         <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
               class="
                  border-0
                  rounded-lg
                  shadow-lg
                  relative
                  flex flex-col
                  w-full
                  bg-white
                  outline-none
                  focus:outline-none
               "
            >
               <!--header-->
               <div
                  class="
                     flex
                     items-start
                     justify-between
                     pl-5
                     pr-5
                     pt-4
                     pb-1
                     align-middle
                     border-b border-solid border-gray-300
                     rounded-t
                  "
               >
                  <h3 class="text-md font-semibold">SPPD #{{ sppd.nomor }}</h3>
                  <button
                     class="
                        p-1
                        ml-auto
                        bg-transparent
                        border-0
                        text-black
                        opacity-5
                        float-right
                        text-md
                        leading-none
                        font-semibold
                        outline-none
                        focus:outline-none
                     "
                     v-on:click="toggleModal()"
                  >
                     <span
                        class="
                           bg-transparent
                           text-black
                           opacity-5
                           h-6
                           w-6
                           text-md
                           block
                           outline-none
                           focus:outline-none
                        "
                     >
                        ×
                     </span>
                  </button>
               </div>
               <!--body-->
               <form @submit.prevent="postSPPD">
                  <ul class="flex">
                     <li class="flex-1 mr-2">
                        <a
                           :class="
                              activeTab == 1
                                 ? 'border-blue-500 py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white'
                                 : 'border-white hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4'
                           "
                           class="text-center block border"
                           href="javascript:void(0)"
                           @click="SetTabActive(1)"
                           >Form Input 1</a
                        >
                     </li>
                     <li class="flex-1 mr-2">
                        <a
                           :class="
                              activeTab == 2
                                 ? 'border-blue-500 py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white'
                                 : 'border-white hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4'
                           "
                           class="text-center block border"
                           @click="SetTabActive(2)"
                           href="javascript:void(0)"
                           >Form Input 2</a
                        >
                     </li>
                  </ul>
                  <div class="relative px-4 py-2 flex-auto">
                     <div class="max-w-xl" style="height: 540px; width: 800px">
                        <div v-if="activeTab == 1">
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-first-name"
                                 >
                                    Nomor Surat
                                 </label>
                                 <input
                                    v-model="sppd.nomor"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-red-500
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                    "
                                    id="grid-first-name"
                                    type="text"
                                 />
                              </div>
                              <div class="w-full md:w-1/2 px-3">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-last-name"
                                 >
                                    Tanggal
                                 </label>
                                 <date-picker
                                    v-model="sppd.date_issue"
                                    valueType="YYYY-MM-DD"
                                    input-class="text-sm block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 ></date-picker>
                              </div>
                           </div>

                           <label
                              class="
                                 block
                                 uppercase
                                 tracking-wide
                                 text-gray-500 text-xs
                                 font-bold
                                 mb-2
                              "
                              for="grid-first-name"
                           >
                              Dasar SPPD
                           </label>
                           <ckeditor
                              :editor="editor"
                              v-model="sppd.dasar"
                              :config="editorConfig"
                           ></ckeditor>

                           <div class="flex flex-wrap -mx-3 mb-3 mt-3">
                              <div class="w-full px-3">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-password"
                                 >
                                    Acara
                                 </label>
                                 <input
                                    v-model="sppd.acara"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-gray-200
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       focus:border-gray-500
                                    "
                                    id="grid-password"
                                    type="text"
                                 />
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full px-3">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-city"
                                 >
                                    Nama Tempat
                                 </label>
                                 <input
                                    v-model="sppd.place_name"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-gray-200
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       focus:border-gray-500
                                    "
                                    id="grid-city"
                                    type="text"
                                 />
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-3">
                              <div class="w-full px-3">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-zip"
                                 >
                                    Alamat
                                 </label>
                                 <input
                                    v-model="sppd.to"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-gray-200
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       focus:border-gray-500
                                    "
                                    id="grid-zip"
                                    type="text"
                                 />
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-3">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-city"
                                 >
                                    Tgl. Berangkat
                                 </label>
                                 <date-picker
                                    v-model="sppd.date_start"
                                    valueType="YYYY-MM-DD"
                                    input-class="text-sm block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 ></date-picker>
                              </div>
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-zip"
                                 >
                                    Tgl. Kembali
                                 </label>
                                 <date-picker
                                    v-model="sppd.date_end"
                                    valueType="YYYY-MM-DD"
                                    input-class="text-sm block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 ></date-picker>
                              </div>
                           </div>
                        </div>
                        <div v-if="activeTab == 2">
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-state"
                                 >
                                    Pemberi Wewenang
                                 </label>
                                 <div class="relative">
                                    <select
                                       v-model="sppd.user_id_auth"
                                       class="
                                          text-sm
                                          block
                                          appearance-none
                                          w-full
                                          bg-gray-200
                                          border border-gray-200
                                          text-gray-500
                                          py-2
                                          px-3
                                          mb-2
                                          rounded
                                          leading-tight
                                          focus:outline-none
                                          focus:bg-white
                                          focus:border-gray-500
                                       "
                                       id="grid-state"
                                    >
                                       <option
                                          v-for="(employe, index) in employes"
                                          :key="index"
                                          :value="employe.id"
                                       >
                                          {{ employe.name }} -
                                          {{ employe.employe.jabatan }}
                                       </option>
                                    </select>
                                    <div
                                       class="
                                          pointer-events-none
                                          absolute
                                          inset-y-0
                                          right-0
                                          flex
                                          items-center
                                          px-2
                                          text-gray-500
                                       "
                                    >
                                       <svg
                                          class="fill-current h-4 w-4"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                       >
                                          <path
                                             d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                          />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-2/5 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-password"
                                 >
                                    Alat Angkutan
                                 </label>
                                 <input
                                    v-model="sppd.transportasi"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-gray-200
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       focus:border-gray-500
                                    "
                                    id="grid-password"
                                    type="text"
                                 />
                              </div>
                              <div class="w-full md:w-3/5 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-password"
                                 >
                                    Sumber Biaya
                                 </label>
                                 <input
                                    v-model="sppd.cost"
                                    class="
                                       text-sm
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-gray-200
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       focus:border-gray-500
                                    "
                                    id="grid-password"
                                    type="text"
                                 />
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-state"
                                 >
                                    Pengguna Anggaran
                                 </label>
                                 <div class="relative">
                                    <select
                                       v-model="sppd.user_id_pjb_finance"
                                       class="
                                          text-sm
                                          block
                                          appearance-none
                                          w-full
                                          bg-gray-200
                                          border border-gray-200
                                          text-gray-500
                                          py-2
                                          px-3
                                          mb-2
                                          rounded
                                          leading-tight
                                          focus:outline-none
                                          focus:bg-white
                                          focus:border-gray-500
                                       "
                                       id="grid-state"
                                    >
                                       <option
                                          v-for="(employe, index) in employes"
                                          :key="index"
                                          :value="employe.id"
                                       >
                                          {{ employe.name }} -
                                          {{ employe.employe.jabatan }}
                                       </option>
                                    </select>
                                    <div
                                       class="
                                          pointer-events-none
                                          absolute
                                          inset-y-0
                                          right-0
                                          flex
                                          items-center
                                          px-2
                                          text-gray-500
                                       "
                                    >
                                       <svg
                                          class="fill-current h-4 w-4"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                       >
                                          <path
                                             d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                          />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-state"
                                 >
                                    Bendahara
                                 </label>
                                 <div class="relative">
                                    <select
                                       v-model="sppd.user_id_finance"
                                       class="
                                          text-sm
                                          block
                                          appearance-none
                                          w-full
                                          bg-gray-200
                                          border border-gray-200
                                          text-gray-500
                                          py-2
                                          px-3
                                          mb-2
                                          rounded
                                          leading-tight
                                          focus:outline-none
                                          focus:bg-white
                                          focus:border-gray-500
                                       "
                                       id="grid-state"
                                    >
                                       <option
                                          v-for="(employe, index) in employes"
                                          :key="index"
                                          :value="employe.id"
                                       >
                                          {{ employe.name }} -
                                          {{ employe.employe.jabatan }}
                                       </option>
                                    </select>
                                    <div
                                       class="
                                          pointer-events-none
                                          absolute
                                          inset-y-0
                                          right-0
                                          flex
                                          items-center
                                          px-2
                                          text-gray-500
                                       "
                                    >
                                       <svg
                                          class="fill-current h-4 w-4"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                       >
                                          <path
                                             d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                          />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="flex -mx-3 mb-2">
                              <ckeditor
                                 :editor="editor"
                                 v-model="sppd.redaktur"
                                 :config="editorConfig"
                              ></ckeditor>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--footer-->
                  <div
                     class="
                        flex
                        items-center
                        justify-end
                        p-2
                        border-t border-solid border-gray-300
                        rounded-b
                     "
                  >
                     <button
                        class="
                           text-red-500
                           background-transparent
                           font-bold
                           uppercase
                           px-6
                           text-sm
                           outline-none
                           focus:outline-none
                           mr-1
                           mb-1
                           float-left
                        "
                        @click.prevent="removeSPPD()"
                     >
                        Remove
                     </button>
                     <button
                        class="
                           text-red-500
                           bg-transparent
                           border border-solid border-red-500
                           hover:bg-red-500
                           hover:text-white
                           active:bg-red-600
                           font-bold
                           uppercase
                           text-sm
                           px-6
                           py-1
                           rounded
                           outline-none
                           focus:outline-none
                           mr-1
                           mb-1
                        "
                        type="button"
                        style="transition: all 0.15s ease"
                        v-on:click="toggleModal()"
                     >
                        Close
                     </button>
                     <button
                        class="
                           text-blue-500
                           background-transparent
                           font-bold
                           uppercase
                           px-6
                           text-sm
                           outline-none
                           focus:outline-none
                           mr-1
                           mb-1
                        "
                        type="submit"
                     >
                        Save Changes
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div
         v-if="showModal"
         class="opacity-25 fixed inset-0 z-40 bg-black"
      ></div>

      <div
         v-if="showModalParticipant"
         class="
            overflow-x-hidden overflow-y-auto
            fixed
            inset-0
            z-50
            outline-none
            focus:outline-none
            justify-center
            items-center
            flex
         "
      >
         <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
               class="
                  border-0
                  rounded-lg
                  shadow-lg
                  relative
                  flex flex-col
                  w-full
                  bg-white
                  outline-none
                  focus:outline-none
               "
            >
               <!--header-->
               <div
                  class="
                     flex
                     items-start
                     justify-between
                     pl-5
                     pr-5
                     pt-4
                     pb-1
                     align-middle
                     border-b border-solid border-gray-300
                     rounded-t
                  "
               >
                  <h3 class="text-md font-semibold">
                     DAFTAR PESERTA SPPD #{{ sppd.nomor }}
                  </h3>
                  <button
                     class="
                        p-1
                        ml-auto
                        bg-transparent
                        border-0
                        text-black
                        opacity-5
                        float-right
                        text-md
                        leading-none
                        font-semibold
                        outline-none
                        focus:outline-none
                     "
                     v-on:click="closeParticipants()"
                  >
                     <span
                        class="
                           bg-transparent
                           text-black
                           opacity-5
                           h-6
                           w-6
                           text-md
                           block
                           outline-none
                           focus:outline-none
                        "
                     >
                        ×
                     </span>
                  </button>
               </div>

               <div class="relative p-6 flex-auto">
                  <div class="max-w-xl" style="height: 550px; width: 800px">
                     <div
                        v-if="showEmployes == 1"
                        class="flex flex-wrap -mx-3 mb-2"
                     >
                        <table class="table-auto w-full">
                           <tbody
                              class="
                                 bg-grey-light
                                 flex flex-col
                                 justify-between
                                 overflow-y-scroll
                                 w-full
                              "
                              style="height: 50vh"
                           >
                              <tr
                                 v-for="(employe, index) in employes"
                                 :key="index"
                              >
                                 <td
                                    class="
                                       border
                                       px-4
                                       py-2
                                       text-sm
                                       align-top
                                       w-1/12
                                    "
                                 >
                                    {{ index + 1 }}
                                 </td>
                                 <td
                                    class="
                                       p-4
                                       w-5/12
                                       border
                                       px-4
                                       py-2
                                       text-sm
                                       align-top
                                    "
                                 >
                                    <span class="font-bold">{{
                                       employe.name
                                    }}</span
                                    ><br />NIP : {{ employe.employe.nip }}
                                 </td>
                                 <td
                                    class="
                                       p-4
                                       w-4/12
                                       border
                                       px-4
                                       py-2
                                       text-sm
                                       align-top
                                    "
                                 >
                                    {{ employe.employe.jabatan }}<br />{{
                                       employe.employe.pangkat
                                    }}
                                 </td>
                                 <td
                                    class="
                                       p-4
                                       w-1/5
                                       border
                                       px-4
                                       py-2
                                       text-sm
                                       align-top
                                    "
                                 >
                                    <button
                                       @click="addParticipant(employe)"
                                       class="
                                          bg-transparent
                                          hover:bg-blue-500
                                          text-blue-700
                                          font-semibold
                                          hover:text-white
                                          text-xs
                                          py-1
                                          px-2
                                          border border-blue-500
                                          hover:border-transparent
                                          rounded
                                          mr-1
                                          mb-1
                                          float-right
                                       "
                                    >
                                       Tambahkan
                                    </button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <button
                           class="
                              mt-4
                              bg-transparent
                              hover:bg-blue-500
                              text-blue-700
                              font-semibold
                              hover:text-white
                              text-xs
                              py-1
                              px-2
                              border border-blue-500
                              hover:border-transparent
                              rounded
                              mr-1
                              mb-1
                              float-right
                           "
                           @click="toggleEmployes(0)"
                        >
                           Batal
                        </button>
                     </div>
                     <div v-else-if="showEmployes == 2">
                        <div class="flex flex-wrap -mx-3 mb-2">
                           <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                              <label
                                 class="
                                    block
                                    uppercase
                                    tracking-wide
                                    text-gray-500 text-xs
                                    font-bold
                                    mb-2
                                 "
                                 for="grid-first-name"
                              >
                                 Nama Peserta
                              </label>
                              <label
                                 class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-gray-200
                                    text-gray-500
                                    border border-red-500
                                    rounded
                                    py-2
                                    px-3
                                    mb-2
                                    leading-tight
                                    focus:outline-none
                                    focus:bg-white
                                 "
                                 for="grid-first-name"
                              >
                                 {{ participant.fullname }}
                              </label>
                           </div>
                        </div>

                        <form class="mt-4" @submit.prevent="postAddParticipant">
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-first-name"
                                 >
                                    Biaya Beban Per Hari
                                 </label>
                                 <input
                                    v-model="participant.cost_per_day"
                                    class="
                                       appearance-none
                                       block
                                       w-full
                                       bg-gray-200
                                       text-gray-500
                                       border border-red-500
                                       rounded
                                       py-2
                                       px-3
                                       mb-2
                                       leading-tight
                                       focus:outline-none
                                       focus:bg-white
                                       text-right
                                    "
                                    id="grid-first-name"
                                    type="text"
                                 />
                              </div>
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-state"
                                 >
                                    Status
                                 </label>
                                 <div class="relative">
                                    <select
                                       v-model="participant.lead"
                                       class="
                                          block
                                          appearance-none
                                          w-full
                                          bg-gray-200
                                          border border-gray-200
                                          text-gray-500
                                          py-2
                                          px-3
                                          mb-2
                                          rounded
                                          leading-tight
                                          focus:outline-none
                                          focus:bg-white
                                          focus:border-gray-500
                                       "
                                       id="grid-state"
                                    >
                                       <option value="1">Penerima Tugas</option>
                                       <option value="0">Pengikut</option>
                                    </select>
                                    <div
                                       class="
                                          pointer-events-none
                                          absolute
                                          inset-y-0
                                          right-0
                                          flex
                                          items-center
                                          px-2
                                          text-gray-500
                                       "
                                    >
                                       <svg
                                          class="fill-current h-4 w-4"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                       >
                                          <path
                                             d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                          />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="flex flex-wrap -mx-3 mb-2">
                              <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-first-name"
                                 >
                                    Tanggal Berangkat
                                 </label>
                                 <date-picker
                                    v-model="participant.start_work"
                                    valueType="YYYY-MM-DD"
                                    input-class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 ></date-picker>
                              </div>
                              <div class="w-full md:w-1/2 px-3">
                                 <label
                                    class="
                                       block
                                       uppercase
                                       tracking-wide
                                       text-gray-500 text-xs
                                       font-bold
                                       mb-2
                                    "
                                    for="grid-last-name"
                                 >
                                    Tanggal Kembali
                                 </label>
                                 <date-picker
                                    v-model="participant.end_work"
                                    valueType="YYYY-MM-DD"
                                    input-class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-3 mb-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 ></date-picker>
                              </div>
                           </div>
                           <button
                              @click="cancelEditParticipant"
                              type="button"
                              class="
                                 mt-4
                                 bg-transparent
                                 hover:bg-blue-500
                                 text-blue-700
                                 font-semibold
                                 hover:text-white
                                 text-xs
                                 py-1
                                 px-2
                                 border border-red-500
                                 hover:border-transparent
                                 rounded
                                 mr-1
                                 mb-1
                                 float-left
                              "
                           >
                              Batal
                           </button>
                           <button
                              type="submit"
                              class="
                                 mt-4
                                 bg-transparent
                                 hover:bg-blue-500
                                 text-blue-700
                                 font-semibold
                                 hover:text-white
                                 text-xs
                                 py-1
                                 px-2
                                 border border-blue-500
                                 hover:border-transparent
                                 rounded
                                 mr-1
                                 mb-1
                                 float-right
                              "
                           >
                              Simpan
                           </button>
                        </form>
                     </div>
                     <div v-else-if="showEmployes == 0">
                        <div class="flex flex-wrap -mx-3 mb-2">
                           <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                              <label
                                 class="
                                    block
                                    uppercase
                                    tracking-wide
                                    text-gray-500 text-xs
                                    font-bold
                                    mb-2
                                 "
                                 for="grid-first-name"
                              >
                                 Acara
                              </label>
                              <label
                                 class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-gray-200
                                    text-gray-500
                                    border border-gray-500
                                    rounded
                                    py-2
                                    px-3
                                    mb-2
                                    leading-tight
                                    focus:outline-none
                                    focus:bg-white
                                 "
                                 for="grid-first-name"
                              >
                                 {{ sppd.acara }}
                              </label>
                           </div>
                           <div class="w-full md:w-1/2 px-3">
                              <label
                                 class="
                                    block
                                    uppercase
                                    tracking-wide
                                    text-gray-500 text-xs
                                    font-bold
                                    mb-2
                                 "
                                 for="grid-last-name"
                              >
                                 Tempat
                              </label>
                              <label
                                 class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-gray-200
                                    text-gray-500
                                    border border-gray-500
                                    rounded
                                    py-2
                                    px-3
                                    mb-2
                                    leading-tight
                                    focus:outline-none
                                    focus:bg-white
                                 "
                                 for="grid-first-name"
                              >
                                 {{ sppd.place_name }}
                              </label>
                           </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                           <table class="table-auto w-full">
                              <thead>
                                 <tr>
                                    <th
                                       colspan="3"
                                       class="border text-sm px-4 py-2"
                                    >
                                       NAMA
                                    </th>
                                    <th class="border text-sm px-4 py-2">
                                       JAB/GOL
                                    </th>
                                    <th
                                       class="border text-sm px-4 py-2"
                                       colspan="2"
                                    >
                                       UANG HARIAN
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr
                                    v-for="(
                                       participant, index
                                    ) in sppd.participants"
                                    :key="index"
                                 >
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       {{ index + 1 }}
                                    </td>
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       <a
                                          href="javascript:void(0)"
                                          @click="
                                             getEditParticipant(
                                                participant,
                                                index
                                             )
                                          "
                                          ><span class="font-bold">{{
                                             participant.user.fullname
                                          }}</span
                                          ><br />NIP :
                                          {{ participant.user.employe.nip }}</a
                                       >
                                    </td>
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       <i v-if="participant.lead == 1">v</i>
                                    </td>
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       {{ participant.user.employe.jabatan
                                       }}<br />{{
                                          participant.user.employe.pangkat
                                       }}
                                    </td>
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       Rp.
                                       <span class="float-right"
                                          >{{
                                             (participant.cost_per_day / 1000)
                                                | fCur
                                          }}
                                          K</span
                                       >
                                    </td>
                                    <td
                                       class="
                                          border
                                          px-4
                                          py-2
                                          text-sm
                                          align-top
                                          font-sm
                                       "
                                    >
                                       <button
                                          @click="
                                             removeParticipant(
                                                participant,
                                                index
                                             )
                                          "
                                          class="
                                             bg-transparent
                                             hover:bg-blue-500
                                             text-blue-700
                                             font-semibold
                                             hover:text-white
                                             text-xs
                                             py-1
                                             px-2
                                             border border-blue-500
                                             hover:border-transparent
                                             rounded
                                             mr-1
                                             mb-1
                                             float-right
                                          "
                                       >
                                          <svg
                                             class="
                                                w-6
                                                text-blue-700
                                                hover:text-white
                                                text-xs
                                             "
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor"
                                          >
                                             <path
                                                fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                             />
                                          </svg>
                                       </button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <button
                              class="
                                 mt-4
                                 bg-transparent
                                 hover:bg-blue-500
                                 text-blue-700
                                 font-semibold
                                 hover:text-white
                                 text-xs
                                 py-1
                                 px-2
                                 border border-blue-500
                                 hover:border-transparent
                                 rounded
                                 mr-1
                                 mb-1
                                 float-left
                              "
                              @click="toggleEmployes(1)"
                           >
                              Tambah
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div
         v-if="showModalParticipant"
         class="opacity-25 fixed inset-0 z-40 bg-black"
      ></div>
      <vue-confirm-dialog></vue-confirm-dialog>
   </app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";

import VueTailwindPicker from "vue-tailwind-picker";
import * as dayjs from "dayjs";

import VueTailwindDatepicker from "@coding-wisely/vue-tailwind-datepicker";

import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
   props: ["data", "employes", "conf", "date"],
   components: {
      AppLayout,
      VueTailwindPicker,
      VueTailwindDatepicker,
      DatePicker,
   },
   data() {
      return {
         editor: ClassicEditor,
         editorData: "<p>Content of the editor.</p>",
         editorConfig: {
            // The configuration of the editor.
            toolbar: [
               "bold",
               "italic",
               "|",
               "link",
               "heading",
               "|",
               "bulletedList",
               "numberedList",
               "alignment",
               "undo",
               "redo",
            ],
         },
         activeTab: 1,
         showModal: false,
         showModalParticipant: false,
         showEmployes: 0,
         letters: null,
         letter_idx: null,
         participant_idx: null,
         participant: new Form({
            id: "",
            letter_id: "",
            user_id: "",
            name: "",
            fullname: "",
            cost_per_day: "",
            lead: 1,
            start_work: this.date.date_add,
            end_work: this.date.date_add,
         }),
         sppd: new Form({
            id: null,
            user_id_auth: this.conf.user_id_auth,
            user_id_finance: this.conf.user_id_finance,
            user_id_pjb_finance: this.conf.user_id_pjb_finance,
            nomor: "",
            transportasi: "Angkutan Darat",
            dasar: "",
            acara: "",
            cost: "",
            from: "Kantor Camat " + this.conf.name,
            place_name: "",
            to: "",
            date_start: this.date.date_add,
            date_end: this.date.date_add,
            place_issue: this.conf.name,
            date_issue: this.date.date_now,
            redaktur: this.conf.redaktur,
         }),
      };
   },
   created() {},
   methods: {
      getResult(page) {
         let uri = "/api/sppd?page=" + page;
         axios
            .get(uri)
            .then((response) => {
               return response.data;
            })
            .then((data) => {
               this.letters = data;
            });
      },
      cancelEditParticipant() {
         this.showEmployes = 0;
         this.clearParticipant();
      },
      clearParticipant() {
         this.participant.id = "";
         this.participant.user_id = "";
         this.participant.name = "";
         this.participant.fullname = "";
         this.participant.cost_per_day = "";
         this.participant.lead = 1;
         this.participant.start_work = "";
         this.participant.end_work = "";
      },
      getEditParticipant(data, index) {
         this.participant_idx = index;
         this.showEmployes = 2;
         this.participant.id = data.id;
         this.participant.user_id = data.user_id;
         this.participant.name = data.user.name;
         this.participant.fullname = data.user.fullname;
         this.participant.cost_per_day = data.cost_per_day;
         this.participant.lead = data.lead;
         this.participant.start_work = data.start_work;
         this.participant.end_work = data.end_work;
         this.participant.letter_id = this.sppd.id;
      },
      toggleEmployes(status) {
         this.showEmployes = status;
      },
      showParticipants(data, index) {
         this.SetDataSPPD(data, index);
         this.showModalParticipant = !this.showModalParticipant;
      },
      closeParticipants() {
         this.showModalParticipant = !this.showModalParticipant;
         this.showEmployes = 0;
      },
      addParticipant(participant) {
         this.showEmployes = 2;
         this.participant.id = "";
         this.participant.cost_per_day = "";
         this.participant.lead = 1;
         this.participant.user_id = participant.id;
         this.participant.name = participant.name;
         this.participant.fullname = participant.fullname;
         this.participant.letter_id = this.sppd.id;
         this.participant.start_work = this.date.date_add;
         this.participant.end_work = this.date.date_add;
      },
      removeParticipant(part, idx_part) {
         this.$confirm({
            message: "Are you sure remove this " + part.user.fullname + "..?",
            button: {
               no: "No",
               yes: "Yes",
            },
            callback: (confirm) => {
               if (confirm) {
                  axios
                     .delete("/api/sppd/participant/" + part.id)
                     .then((res) => {
                        this.letters.data[this.letter_idx].participants.splice(
                           idx_part,
                           1
                        );
                     });
               }
            },
         });
      },
      postAddParticipant() {
         if (this.participant.id == "") {
            this.participant.post("/api/sppd/participant").then((res) => {
               this.showEmployes = 0;
               this.letters.data[this.letter_idx].participants.unshift(
                  res.data.data
               );
            });
         } else {
            this.participant
               .put("/api/sppd/participant/" + this.participant.id)
               .then((res) => {
                  this.showEmployes = 0;
                  this.letters.data[this.letter_idx].participants[
                     this.participant_idx
                  ].cost_per_day = this.participant.cost_per_day;
                  this.letters.data[this.letter_idx].participants[
                     this.participant_idx
                  ].lead = this.participant.lead;
                  this.letters.data[this.letter_idx].participants[
                     this.participant_idx
                  ].start_work = this.participant.start_work;
                  this.letters.data[this.letter_idx].participants[
                     this.participant_idx
                  ].end_work = this.participant.end_work;
               });
         }
      },
      addNewSPPD() {
         this.clearForm();
         this.showModal = !this.showModal;
      },
      SetTabActive(active) {
         this.activeTab = active;
      },
      postSPPD() {
         if (this.sppd.id != null) {
            this.sppd.put("/api/sppd/" + this.sppd.id).then((res) => {
               this.showModal = !this.showModal;
               if (res.data.status == true) {
                  this.letters.data[this.letter_idx].user_id_auth =
                     this.sppd.user_id_auth;
                  this.letters.data[this.letter_idx].user_id_finance =
                     this.sppd.user_id_finance;
                  this.letters.data[this.letter_idx].user_id_pjb_finance =
                     this.sppd.user_id_pjb_finance;
                  this.letters.data[this.letter_idx].nomor = this.sppd.nomor;
                  this.letters.data[this.letter_idx].transportasi =
                     this.sppd.transportasi;
                  this.letters.data[this.letter_idx].dasar = this.sppd.dasar;
                  this.letters.data[this.letter_idx].acara = this.sppd.acara;
                  this.letters.data[this.letter_idx].cost = this.sppd.cost;
                  this.letters.data[this.letter_idx].from = this.sppd.from;
                  this.letters.data[this.letter_idx].place_name =
                     this.sppd.place_name;
                  this.letters.data[this.letter_idx].to = this.sppd.to;
                  this.letters.data[this.letter_idx].date_start =
                     this.sppd.date_start;
                  this.letters.data[this.letter_idx].date_end =
                     this.sppd.date_end;
                  this.letters.data[this.letter_idx].place_issue =
                     this.sppd.place_issue;
                  this.letters.data[this.letter_idx].date_issue =
                     this.sppd.date_issue;
                  this.letters.data[this.letter_idx].redaktur =
                     this.sppd.redaktur;
               }
            });
         } else {
            this.sppd.post("/api/sppd").then((res) => {
               this.showModal = !this.showModal;
               this.getResult(0);
            });
         }
      },
      setStartDate(startDate) {
         this.form.startDate = startDate;
      },
      toggleModal: function (data, index) {
         this.showModal = !this.showModal;
         if (this.showModal) {
            this.SetDataSPPD(data, index);
         } else {
            this.activeTab = 1;
         }
      },
      SetDataSPPD(data, index) {
         this.letter_idx = index;
         // this.sppd = data
         this.sppd.id = data.id;
         this.sppd.user_id_auth = data.user_id_auth;
         this.sppd.user_id_finance = data.user_id_finance;
         this.sppd.user_id_pjb_finance = data.user_id_pjb_finance;
         this.sppd.nomor = data.nomor;
         this.sppd.transportasi = data.transportasi;
         this.sppd.dasar = data.dasar;
         this.sppd.acara = data.acara;
         this.sppd.cost = data.cost;
         this.sppd.from = data.from;
         this.sppd.place_name = data.place_name;
         this.sppd.to = data.to;
         this.sppd.date_start = data.date_start;
         this.sppd.date_end = data.date_end;
         this.sppd.place_issue = data.place_issue;
         this.sppd.date_issue = data.date_issue;
         this.sppd.redaktur = data.redaktur;
         this.sppd.participants = data.participants;
      },
      clearForm() {
         this.sppd.id = null;
         this.sppd.user_id_auth = this.conf.user_id_auth;
         this.sppd.user_id_finance = this.conf.user_id_finance;
         this.sppd.user_id_pjb_finance = this.conf.user_id_pjb_finance;
         this.sppd.nomor = "";
         this.sppd.transportasi = "Angkutan Darat";
         this.sppd.dasar = "";
         this.sppd.acara = "";
         this.sppd.cost = "Kantor Camat " + this.conf.name;
         this.sppd.from = "Kantor Camat " + this.conf.name;
         this.sppd.place_name = "";
         this.sppd.to = "";
         (this.sppd.date_start = this.date.date_add),
            (this.sppd.date_end = this.date.date_add),
            (this.sppd.place_issue = this.conf.name);
         (this.sppd.date_issue = this.date.date_now),
            (this.sppd.redaktur = this.conf.redaktur);
      },
      printSPPD(num_validate) {
         let url_href = "/dashboard/sppd/print/" + num_validate;
         window.open(url_href);
      },
      removeSPPD() {
         this.$confirm({
            message: "Are you sure remove this " + this.sppd.nomor + "..?",
            button: {
               no: "No",
               yes: "Yes",
            },
            callback: (confirm) => {
               if (confirm) {
                  this.showModal = !this.showModal;
                  axios.delete("/api/sppd/" + this.sppd.id).then((res) => {
                     this.letters.data.splice(this.letter_idx, 1);
                     this.clearForm();
                  });
               }
            },
         });
      },
   },
   mounted() {
      this.letters = this.data;
   },
};
</script>

<style lang="css" scoped>
.mx-datepicker {
   position: relative;
   display: inline-block;
   width: 100%;
}
</style>