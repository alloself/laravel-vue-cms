import { PKG_NAME } from '@/const';

export function capitalize(str) {
  function upperToHyphenLower(match) {
    return '' + match[1].toUpperCase();
  }
  const regStr = str.replace(/-\w/, upperToHyphenLower);
  return regStr.charAt(0).toUpperCase() + regStr.slice(1);
}
export function lowercase(str) {
  return str.charAt(0).toLowerCase() + str.slice(1);
}
export const getValue = (key) => {
  const value = localStorage.getItem(`${PKG_NAME}:${key}`);
  return value ? JSON.parse(atob(value)) : value;
}
export const removeValue = (key) => {
  return localStorage.removeItem(`${PKG_NAME}:${key}`);
}
export const setValue = (key, value) => {
  const val = btoa(JSON.stringify(value));
  localStorage.setItem(`${PKG_NAME}:${key}`, val);
}
