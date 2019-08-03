import firebase from "firebase/app";
import "firebase/firestore";

var firebaseConfig = {
  apiKey: "AIzaSyCo5HGaWuev-uwd8T-iUpNgm0gHoD3pZaI",
  authDomain: "lista-del-supermercado.firebaseapp.com",
  databaseURL: "https://lista-del-supermercado.firebaseio.com",
  projectId: "lista-del-supermercado",
  storageBucket: "",
  messagingSenderId: "465217254262",
  appId: "1:465217254262:web:2f4f7f34394b914f"
};

firebase.initializeApp(firebaseConfig);

export const db = firebase.firestore();
