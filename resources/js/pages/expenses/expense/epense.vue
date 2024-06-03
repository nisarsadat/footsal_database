<template>
    <div class=" text-3xl font-semibold leading-snug font-serif  boxShadow" flat>
      <div class="margin display">
        <v-card-text class="alph">
        ||<strong class="book">
          <span class="mdi mdi-expansion-card-variant "></span>
          ALL EXPENSE
        </strong>
            
      </v-card-text>
      <ExpensePopup />
      </div>
      
      
      <div class="
      margin"><ExpenseTable /></div>
    </div>
  </template>
  
  <script>
  import ExpensePopup from './expencepopup.vue';
  import ExpenseTable from './expensetable.vue';
  
  export default {
    components: {
      ExpensePopup,
      ExpenseTable,
    },
  };
  </script>
  
  <style>
  .book {
    font-size: 18px;
    font-weight: bolder;
    letter-spacing: 12px;
    line-height: 3;
  }
  .alph {
    font-size: 18px;
    font-weight: bolder;
    line-height: 3;
  }
  .boxShadow {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
    margin-top: 30px;
  }
 
  .display
  {
    display: flex;
  }
  </style>
   .margin {
    width: 90%;
    height: 90%;
    margin: 0 auto;
  }