import { VERSION, NAME } from '$env/static/private';

let version = VERSION;
let name = NAME;

export const load = () =>{
	return { version, name };
};