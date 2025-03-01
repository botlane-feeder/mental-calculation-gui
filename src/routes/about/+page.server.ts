// import { VERSION, NAME } from '$env/static/private';
import pkg from '../../../package.json'

let version = pkg["version"];
let name = pkg["name"];

export const load = () =>{
	return { version, name };
};