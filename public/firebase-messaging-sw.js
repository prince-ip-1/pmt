importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyDIJOeRR9xG2R2Xi80k0SWIAjc7u_X2d7I",
    projectId: "project-management-tool-60f18",
    messagingSenderId: "642891304835",
    appId: "1:642891304835:web:35199e28a85f1e8565b0b6"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});