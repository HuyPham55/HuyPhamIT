import {Author} from "@/pages/post-index/PostIndex";

export declare type TagType = {
    id: string;
    name: string;
    slug: string;
}

export declare type PostDetailType = {
    id: number;
    hash: string;
    title: string;
    short_description: string;
    content: string;
    publish_date: string;
    reading_time: number;
    reading_time_display: string;
    author?: Author;
    tags?: Array<TagType>;
}
