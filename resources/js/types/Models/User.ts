import { Timestamps } from "../Shared/Timestamps";

export interface User extends Timestamps {
    name: string;
    email: string;
}
