<ul class="radio-switch margin-left-xs margin-top-xs">
   <li class="radio-switch__item">
     <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-mobile-switch" data-theme="light" id="radio-3" {{auth()->user()->theme() == 'light' ? 'checked' : ''}}>
     <label class="radio-switch__label" for="radio-3"><svg class="icon icon--xs" viewBox="0 0 16 16">
         <title>Enable light mode</title>
         <path d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.414-1.414zM14 7h2v2h-2zM12.95 14.433l-1.415-1.414 1.414-1.414 1.415 1.413zM7 14h2v2H7zM2.98 14.363L1.566 12.95l1.415-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.707L4.465 3.12 3.05 4.535 1.636 3.121z" />
         <path d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4z" />
       </svg></label>
   </li>
   <li class="radio-switch__item">
     <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-mobile-switch" data-theme="dark" id="radio-4" {{auth()->user()->theme() == 'dark' ? 'checked' : ''}}>
     <label class="radio-switch__label" for="radio-4"><svg class="icon icon--xs" viewBox="0 0 16 16">
         <title>Enable dark mode</title>
         <path d="M6,0C2.5,0.9,0,4.1,0,7.9C0,12.4,3.6,16,8.1,16c3.8,0,6.9-2.5,7.9-6C9.9,11.7,4.3,6.1,6,0z"></path>
       </svg></label>
     <div aria-hidden="true" class="radio-switch__marker"></div>
   </li>
 </ul>
</ul>