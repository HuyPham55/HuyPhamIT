import {TagType} from "@/pages/post-detail/PostDetail";

declare type PostItem = {
    id: number;
    hash: string;
    title: string;
    short_description: string;
    publish_date: string;
    author?: Author
    tags?: Array<TagType>
}

declare type PostList = {
    data: Array<PostItem>;
    loading: Boolean;
}

declare type Author = {
    id: string;
    name: string;
    profile_picture: string;
    description: string;
}

export {PostItem, PostList, Author}
