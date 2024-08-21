<template>
    <div class="football-goal-animation">
      <div class="football-goal">
        <div class="post post-left"></div>
        <div class="post post-right"></div>
        <div class="crossbar"></div>
        <div class="ball"></div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'FootballGoalAnimation'
  }
  </script>
  
  <style scoped>
  .football-goal-animation {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px; /* Adjust the height as needed */
  }
  
  .football-goal {
    width: 200px;
    height: 100px;
    position: relative;
    animation: bounce 2s ease-in-out infinite;
  }
  
  .post {
    width: 20px;
    height: 100px;
    background-color: #000000; /* Black color for the posts */
    position: absolute;
  }
  
  .post-left {
    left: 0;
  }
  
  .post-right {
    right: 0;
  }
  
  .crossbar {
    width: 200px;
    height: 20px;
    background-color: #000000; /* Black color for the crossbar */
    position: absolute;
    top: 40px;
  }
  
  .ball {
    width: 30px;
    height: 30px;
    background-color: #FFCC00; /* Yellow color for the ball */
    border-radius: 50%;
    position: absolute;
    top: 35px;
    left: 85px;
    animation: bounce 2s ease-in-out infinite;
  }
  
  @keyframes bounce {
    0% { transform: translateY(0); }
    50% { transform: translateY(20px); }
    100% { transform: translateY(0); }
  }
  </style>